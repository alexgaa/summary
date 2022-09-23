<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Crud\WorkCrud;
use App\Http\Controllers\AuthTrait;
use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    use AuthTrait;
    const ERROR_MASSAGE_NO_ACCESS = 'You do not have edit access!';

    /** @var WorkCrud  */
    private $workCrud;

    public function __construct()
    {
        $this->workCrud = new WorkCrud();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $listUserIds = $this->getUsersListIdsIncludesAdmin();

        $works = $this->workCrud->read($listUserIds, 5);
        return view('admin.work.index', compact('works'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.work.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if(!$this->workCrud->create($request, Auth::user()->id)) {
            return redirect()->back()->withErrors(['errorForm' =>"Save error!"]);
        }
        return redirect()->back()->with('status', 'Work ' . $request->name . ' added');
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $work = Work::query()->find($id);
        if(!$this->checkAccessUser($work)){
            return redirect()->back()->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
        }
        return view('admin.work.edit', compact('work'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $statusMessage = "Error! Work - id =" . $id . " not found!";
        $work = Work::query()->find($id);
        if ($work) {
           if ($this->workCrud->update($request, $id)) {
                $statusMessage = "Work - '" . $request->name . "' updated!";
                return redirect()
                    ->back()
                    ->with('status', $statusMessage);
           }
           $statusMessage = "Update error!";
        }
        return redirect()->back()->withErrors(['errorForm' =>$statusMessage]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $statusMessage = "Work id = " . $id . " not found!";
        $work = Work::query()->find($id);

        if($work) {
            $nameWork = $work->name;
            if(!$this->checkAccessUser($work)){
                $statusMessage = self::ERROR_MASSAGE_NO_ACCESS;
            } else {
                $this->workCrud->delete($id);
                $statusMessage = "Work '" . $nameWork  . "' deleted!";
                return redirect()->back()->with('status', $statusMessage);
            }
        }
        return redirect()->back()->withErrors(['errorForm' => $statusMessage]);
    }
}
