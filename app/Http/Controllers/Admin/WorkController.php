<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WorkController extends Controller
{
    private const RULES_FOR_VALIDATION_NAME = 'required|min:2|unique:works|max:255';
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $works = Work::query()->orderBy('name')->paginate(5);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => self::RULES_FOR_VALIDATION_NAME
        ]);
        $work = new Work();
        $work->name = $request->name;
        $work->description = $request->description;
        $work->save();

        return redirect()->route('work.create')->with('status', 'Work ' . $request->name . ' added');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $work = Work::query()->find($id);
        return view('admin.work.edit', compact('work'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $work = Work::query()->find($id);
        if($work) {
            if ($work->name != $request->name) {
                $request->validate([
                    'name' => self::RULES_FOR_VALIDATION_NAME
                ]);
                $work->name = $request->name;
            }
            $work->description = $request->description;
            $work->save();
            $statusMessage = "Work - '" . $request->name . "' updated!";
            return redirect()
                ->route('work.edit', compact('work'))
                ->with('status', $statusMessage);
        }
        $statusMessage = "Error! Technology - id =" . $id . " not found!";
        return redirect()->route('admin.index')->with('error', $statusMessage);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $work = Work::query()->find($id);
        if($work) {
            $nameWork = $work->name;
            $work->delete();
            $statusMessage = "Technology '" . $nameWork  . "' deleted!";
        } else {
            $statusMessage = "Technology id = " . $id . " not found!";
        }
        return redirect()->route('work.index')->with('status', $statusMessage);
    }
}
