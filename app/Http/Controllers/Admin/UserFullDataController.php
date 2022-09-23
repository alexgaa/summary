<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Crud\ExperienceCrud;
use App\Crud\TechnologyCrud;
use App\Crud\UserFullDataCrud;
use App\Crud\WorkCrud;
use App\Http\Controllers\AuthTrait;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\UserFullData;
use App\Models\Work;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFullDataController extends Controller
{
    use AuthTrait;

    private const ERROR_MASSAGE_NO_ACCESS = 'You do not have edit access!';

    /** @var ExperienceCrud  */
    private $experienceCrud;
    /** @var TechnologyCrud  */
    private $technologyCrud;
    /** @var WorkCrud  */
    private $workCrud;
    /** @var UserFullDataCrud  */
    private $usersFullDataCrud;

    public function __construct()
    {
        $this->experienceCrud = new ExperienceCrud();
        $this->technologyCrud = new TechnologyCrud();
        $this->workCrud = new WorkCrud();
        $this->usersFullDataCrud = new UserFullDataCrud();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $listUserIds = $this->getOnlyUsersListIds();

        $technology = new Technology();
        $technologies = $technology->selectExperienceWithTechnology($listUserIds);
        $work = new Work();
        $works = $work->selectExperienceWithWork($listUserIds);

        $usersFullData = $this->usersFullDataCrud->read($listUserIds);

        return view('admin.userFullData.index', compact('usersFullData', 'technologies', 'works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $listUserIds = $this->getOnlyUsersListIds();
        $usersFullData = $this->usersFullDataCrud->read($listUserIds);

        return view('admin.userFullData.create', compact('usersFullData'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if(!$this->usersFullDataCrud->create($request, Auth::user()->id)) {
            return redirect()->route('user-full-data.create')->withErrors(['errorForm' =>"Save error!"]);
        }

        return redirect()->route('admin.userFullData.index')->with('status', 'User data for: ' . $request->name . ' - added!');
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $userFullData = UserFullData::query()->find($id);
        if(!$this->checkAccessUser($userFullData)){
            return redirect()->route('user-full-data.index')->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
        }

        return view('admin.userFullData.edit', compact('userFullData'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        if($this->usersFullDataCrud->update($request, $id)) {
            $statusMessage = "User data - '" . $request->name . "' - updated!";
            return redirect()
                ->route('user-full-data.edit', ["user_full_datum"=>$id])
                ->with('status', $statusMessage);
        }
        $statusMessage = "Error! User - id =" . $id . " not found!";

        return redirect()->route('admin.index')->with('error', $statusMessage);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $userFullData = UserFullData::query()->find($id);

        if($userFullData) {
            if(!$this->checkAccessUser($userFullData)){
                return redirect()->back()->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
            }
            $nameUserFullData = $userFullData->name;
            $this->usersFullDataCrud->delete($id);
            $statusMessage = "User '" . $nameUserFullData  . "' deleted!";
        } else {
            $statusMessage = "User id = " . $id . " not found!";
        }

        return redirect()->route('user-full-data.index')->with('status', $statusMessage);
    }
}
