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
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    private const VALIDATE_RULES = [
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
        'company_name' => 'required|max:255|min:2',
        'position' => 'required|max:100|min:2'
    ];

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $technologies = DB::table('experiences')
            ->select('experiences.id',
                'experience_technology.priority',
                'technologies.name as technology_name')
            ->join('experience_technology',
                'experience_technology.experience_id',
                '=', 'experiences.id')
            ->join('technologies',
                'experience_technology.technology_id',
                '=', 'technologies.id')
            ->orderBy('experience_technology.priority')
            ->get();

        $works = DB::table('experiences')
            ->select('experiences.id',
                'experience_work.priority',
                'works.name as work_name')
            ->join('experience_work',
                'experience_work.experience_id',
                '=', 'experiences.id')
            ->join('works',
                'experience_work.work_id',
                '=', 'works.id')
            ->orderBy('experience_work.priority')
            ->get();

        $experiences = DB::table('experiences')
            ->orderByDesc('experiences.start_date')
            ->paginate(3);



        return view('admin.experience.index', compact('experiences', 'technologies', 'works'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $technologies = Technology::query()->orderBy('name')->pluck('name', 'id');
        $works = Work::query()->orderBy('name')->pluck('name', 'id');
        return view('admin.experience.create', compact('technologies', 'works'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(self::VALIDATE_RULES);

        $experience = new Experience();
        $experience->company_name = $request->company_name;
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
        $technologies = Technology::query()->orderBy('name')->pluck('name', 'id');
        $works = Work::query()->orderBy('name')->pluck('name', 'id');
        return view('admin.experience.edit', compact("experience", "technologies", "works"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $experience = Experience::query()->find($id);
        if($experience) {
            $request->validate(self::VALIDATE_RULES);
            $experience->start_date = $request->start_date;
            $experience->end_date = $request->end_date;
            $experience->company_name = $request->company_name;
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
    public function destroy($id): RedirectResponse
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

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function sortingTechnologies(int $id)
    {
        $experience = Experience::query()->find($id);
        return view('admin.experience.sortingTechnologies', compact('experience'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function sortingTechnologiesUpdate(Request $request, $id): RedirectResponse
    {
        $experience = Experience::query()->find($id);
        $experience->technologies()->sync([]);

        foreach ($request->technologies as $technologyId => $technologyPriority){
            $experience->technologies()->attach($technologyId,['priority' => (int)$technologyPriority]);
        }
        $statusMessage = "Technology priorities updated";
        return redirect()->route('experience.index')->with([
            'status' => $statusMessage,
        ]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function sortingWorks(int $id)
    {
        $experience = Experience::query()->find($id);
        return view('admin.experience.sortingWorks', compact('experience'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function sortingWorksUpdate(Request $request, $id): RedirectResponse
    {
        $experience = Experience::query()->find($id);
        $experience->works()->sync([]);

        foreach ($request->works as $workId => $workPriority){
            $experience->works()->attach($workId,['priority' => (int)$workPriority]);
        }
        $statusMessage = "Work priorities updated";
        return redirect()->route('experience.index')->with([
            'status' => $statusMessage,
        ]);
   }
}


