<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class TechnologyController extends Controller
{
    private const RULES_FOR_VALIDATION_NAME = 'required|min:2|unique:technologies|max:255';

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $technologies = Technology::query()->paginate(5);
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
    public function store(Request $request)
    {
        $request->validate([
            'name'=>self::RULES_FOR_VALIDATION_NAME,
        ]);
        $technology = new Technology();
        $technology->name = $request->name;
        $technology->comment = $request->comment;
        $technology->save();

        return redirect()->route('technology.create')->with('status', 'Technology ' . $request->name . ' added');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $technology = Technology::query()->find($id);
        return view('admin.technology.edit', compact('technology'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $technology = Technology::query()->find($id);
        if($technology) {
            if($technology->name != $request->name) {
                $request->validate([
                    'name'=>self::RULES_FOR_VALIDATION_NAME,
                ]);
                $technology->name = $request->name;
            }

            $technology->comment = $request->comment;
            $technology->save();
            $statusMessage = "Technology - '" . $request->name . "' updated!";
            return redirect()
                ->route('technology.edit', compact('technology'))
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
        $technology = Technology::query()->find($id);

        if($technology) {
            $nameTechnology = $technology->name;
            $technology->delete();
            $statusMessage = "Technology '" . $nameTechnology  . "' deleted!";
        } else {
            $statusMessage = "Technology id = " . $id . " not found!";
        }

        return redirect()->route('technology.index')->with('status', $statusMessage);
    }
}
