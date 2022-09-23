<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Crud\TechnologyCrud;
use App\Http\Controllers\AuthTrait;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class TechnologyController extends Controller
{
    use AuthTrait;
    const ERROR_MASSAGE_NO_ACCESS = 'You do not have edit access!';

    /** @var TechnologyCrud  */
    private $technologyCrud;

    public function __construct()
    {
        $this->technologyCrud = new TechnologyCrud();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $listUserIds = $this->getUsersListIdsIncludesAdmin();
        $technologies = $this->technologyCrud->read($listUserIds);
        return view('admin.technology.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.technology.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if(!$this->technologyCrud->create($request, Auth::user()->id)) {
            return redirect()->back()->withErrors(['errorForm' =>"Save error!"]);
        }
        return redirect()->back()->with('status', 'Technology ' . $request->name . ' added');
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $technology = Technology::query()->find($id);
        if(!$this->checkAccessUser($technology )){
            return redirect()->back()->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
        }
        return view('admin.technology.edit', compact('technology'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $statusMessage = "Error! Technology - id =" . $id . " not found!";
        $technology = Technology::query()->find($id);
        if ($technology) {
            if ($this->technologyCrud->update($request, $id)) {
                $statusMessage = "Technology - '" . $request->name . "' updated!";
                return redirect()
                    ->route('technology.index')
                    ->with('status', $statusMessage);
            }
            $statusMessage = "Update error!";
        }
        return redirect()->route('technology.index')->withErrors(['errorForm' =>$statusMessage]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $statusMessage = "Technology id = " . $id . " not found!";
        $technology = Technology::query()->find($id);

        if($technology) {
            $nameTechnology = $technology->name;
            if(!$this->checkAccessUser($technology )){
                $statusMessage = self::ERROR_MASSAGE_NO_ACCESS;
            } else {
                $this->technologyCrud->delete($id);
                $statusMessage = "Technology '" . $nameTechnology  . "' deleted!";
                return redirect()->back()->with('status', $statusMessage);
            }
        }
        return redirect()->back()->withErrors(['errorForm' => $statusMessage]);
    }
}
