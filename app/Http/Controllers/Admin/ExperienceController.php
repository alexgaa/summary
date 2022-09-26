<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Crud\ExperienceCrud;
use App\Crud\TechnologyCrud;
use App\Crud\WorkCrud;
use App\Http\Controllers\AuthTrait;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Technology;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    use AuthTrait;
    private const ERROR_MASSAGE_NO_ACCESS = 'You do not have edit access!';

    /** @var ExperienceCrud  */
    private $experienceCrud;
    /** @var TechnologyCrud  */
    private $technologyCrud;
    /** @var WorkCrud  */
    private $workCrud;

    public function __construct()
    {
        $this->experienceCrud = new ExperienceCrud();
        $this->technologyCrud = new TechnologyCrud();
        $this->workCrud = new WorkCrud();
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
        $experiences = $this->experienceCrud->read($listUserIds, 5);

        return view('admin.experience.index', compact('experiences', 'technologies', 'works'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(): View
    {
        $listUserIds = $this->getUsersListIdsIncludesAdmin();

        $technologies = $this->technologyCrud->read($listUserIds)->pluck('name', 'id');
        $works = $this->workCrud->read($listUserIds)->pluck('name', 'id');

        return view('admin.experience.create', compact('technologies', 'works'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if(!$this->experienceCrud->create($request, Auth::user()->id)) {
            return redirect()->route('experience.create')->withErrors(['errorForm' =>"Save error!"]);
        }
        return redirect()->back()->with('status', 'Experience ' . $request->name . ' added.');
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $experience = Experience::query()->find($id);
        if(!$this->checkAccessUser($experience)){
            return redirect()->back()->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
        }
            $listUserIds = $this->getUsersListIdsIncludesAdmin();
            $technologies = $this->technologyCrud->read($listUserIds)->pluck('name', 'id');
            $works = $this->workCrud->read($listUserIds)->pluck('name', 'id');
            return view('admin.experience.edit', compact("experience", "technologies", "works"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $statusMessage = "Error! Experience - id =" . $id . " not found!";
        $experience = Experience::query()->find($id);
        if ($experience) {
            if ($this->experienceCrud->update($request, $id)) {
                $statusMessage = "Experience - '" . $request->name . "' updated!";
                return redirect()
                    ->back()
                    ->with('status', $statusMessage);
            }
            $statusMessage = "Update error!";
        }
        return redirect()->route('experience.index')->withErrors(['errorForm' =>$statusMessage]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $statusMessage = "Experience id = " . $id . " not found!";
        $experience = Experience::query()->find($id);

        if($experience) {
            $nameExperience = $experience->name;
            if(!$this->checkAccessUser($experience)){
                $statusMessage = self::ERROR_MASSAGE_NO_ACCESS;
            } else {
                $this->experienceCrud->delete($id);
                $statusMessage = "Experience '" . $nameExperience  . "' deleted!";
                return redirect()->back()->with('status', $statusMessage);
            }
        }
        return redirect()->back()->withErrors(['errorForm' => $statusMessage]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function sortingTechnologies(int $id)
    {
        $experience = Experience::query()->find($id);

        if(!$this->checkAccessUser($experience)){
            return redirect()->route('experience.index')->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
        }
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
        if ($request->technologies) {
            foreach ($request->technologies as $technologyId => $technologyPriority) {
                $experience->technologies()->attach($technologyId, ['priority' => (int)$technologyPriority]);
            }
        }
        $statusMessage = "Technology priorities updated";
        return redirect()->route('experience.index')->with(['status' => $statusMessage]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function sortingWorks(int $id)
    {
        $experience = Experience::query()->find($id);

        if(!$this->checkAccessUser($experience)) {
            return redirect()->route('experience.index')->withErrors(['errorForm' => self::ERROR_MASSAGE_NO_ACCESS]);
        }

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
        if ($request->works) {
            foreach ($request->works as $workId => $workPriority) {
                $experience->works()->attach($workId, ['priority' => (int)$workPriority]);
            }
        }
        $statusMessage = "Work priorities updated";
        return redirect()->route('experience.index')->with([
            'status' => $statusMessage,
        ]);
   }
}

