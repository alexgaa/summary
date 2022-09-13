<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Technology;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ExperienceController extends Controller
{
    private const VALIDATE_RULES = [
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
        'position' => 'required|max:100|min:2'
    ];

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $experiences = Experience::query()->with(['technologies', 'works'])->paginate(5);
        return view('admin.experience.index', compact('experiences'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $technologies = Technology::query()->pluck('name', 'id');
        $works = Work::query()->pluck('name', 'id');
        return view('admin.experience.create', compact('technologies', 'works'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(self::VALIDATE_RULES);

        $experience = new Experience();
        $experience->start_date = $request->start_date;
        $experience->end_date = $request->end_date;
        $experience->position = $request->position;
        $experience->save();
        $experience->technologies()->attach($request->technologies);
        $experience->works()->attach($request->works);
        return redirect()->route('experience.create')->with('status', 'Experience ' . $request->position . ' added');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $experience = Experience::query()->find($id);
        $technologies = Technology::query()->pluck('name', 'id');
        $works = Work::query()->pluck('name', 'id');
        return view('admin.experience.edit', compact("experience", "technologies", "works"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $experience = Experience::query()->find($id);
        if($experience) {
            $request->validate(self::VALIDATE_RULES);
            $experience->start_date = $request->start_date;
            $experience->end_date = $request->end_date;
            $experience->position = $request->position;
            $experience->save();


            $experience->technologies()->sync($request->technologies);
            $experience->works()->sync($request->works);

            $statusMessage = "Experience - '" . $request->position . "' updated!";
            return redirect()
                ->route('experience.edit', compact('experience'))
                ->with('status', $statusMessage);
        }

        $statusMessage = "Error! Experience - id =" . $id . " not found!";
        return redirect()->route('admin.index')->with('error', $statusMessage);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $errorMessage = 'Experience not found!!';
        $statusMessage = null;
        $experience = Experience::query()->find($id);
        if($experience){
            $statusMessage = 'The Experience "' . $experience->position .'" delete!';
            $errorMessage = null;
            $experience->technologies()->sync([]);
            $experience->works()->sync([]);

            $experience->delete();
        }
        return redirect()->route('experience.index')->with([
            'status' => $statusMessage,
            'error' => $errorMessage
        ]);
    }
}
