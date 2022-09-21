<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\User;
use App\Models\UserFullData;
use App\Models\Work;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserFullDataController extends Controller
{
    private const RULES_FOR_VALIDATION = [
        'user_id' => 'required|integer|unique:user_full_data',
        'name' => 'required|max:255|min:2',
        'lastName' => 'nullable|max:255|min:2',
        'middleName' => 'nullable|max:255|min:2',
        'contact' =>'nullable',
        'address' =>'nullable',
        'dateOfBirth' =>'nullable|date',
        'mainSkills' =>'nullable',
        'education' =>'nullable',
        'workLocation' =>'nullable',
        'jobTitle' =>'nullable',
        'achievements' =>'nullable',
        'personalQualities' =>'nullable',
        'other' =>'nullable',
    ];

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $technology = new Technology();
        $technologies = $technology->selectExperienceWithTechnology();
        $work = new Work();
        $works = $work->selectExperienceWithWork();

        $usersFullData = UserFullData::query()->orderBy('name')->paginate(1);
        return view('admin.userFullData.index', compact('usersFullData', 'technologies', 'works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.email')
            ->leftJoin('user_full_data',
                'users.id',
                '=',
                'user_full_data.user_id')
            ->whereNull('user_full_data.user_id')->get();

        return view('admin.userFullData.create', compact('users'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(self::RULES_FOR_VALIDATION);

        $user = User::query()->find($request->user_id);
        if($user){
            $userData = new UserFullData();
            $userData->user_id = $request->user_id;
            $this->saveUserFullData($userData, $request);
        }

        return redirect()->route('user-full-data.create')->with('status', 'User data for: ' . $request->name . ' - added!');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $userFullData = UserFullData::query()->find($id);

        return view('admin.userFullData.edit', compact('userFullData'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $userFullData = UserFullData::query()->find($id);
        if($userFullData) {
            $request->validate(self::RULES_FOR_VALIDATION);
            $this->saveUserFullData($userFullData, $request);
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
            $nameUserFullData = $userFullData->name;
            $userFullData->delete();
            $statusMessage = "User '" . $nameUserFullData  . "' deleted!";
        } else {
            $statusMessage = "User id = " . $id . " not found!";
        }

        return redirect()->route('user-full-data.index')->with('status', $statusMessage);
    }

    /**
     * @param UserFullData $userData
     * @param Request $request
     * @return void
     */
    private function saveUserFullData(UserFullData $userData, Request $request): void
    {
        $userData->name = $request->name;
        $userData->lastName = $request->lastName;
        $userData->middleName = $request->middleName;
        $userData->contact = $request->contact;
        $userData->address = $request->address;
        $userData->dateOfBirth = $request->dateOfBirth;
        $userData->mainSkills = $request->mainSkills;
        $userData->education = $request->education;
        $userData->workLocation = $request->workLocation;
        $userData->jobTitle = $request->jobTitle;
        $userData->achievements = $request->achievements;
        $userData->personalQualities = $request->personalQualities;
        $userData->other = $request->other;
        $userData->save();
    }
}
