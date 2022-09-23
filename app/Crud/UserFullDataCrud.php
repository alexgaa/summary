<?php

declare(strict_types=1);

namespace App\Crud;

use App\Models\Experience;
use App\Models\User;
use App\Models\UserFullData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserFullDataCrud
{
    private const RULES_FOR_VALIDATION = [
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
     * @param array $usersId
     * @param int $paginatePage
     * @param string $orderByColumn
     * @return LengthAwarePaginator
     */
    public function read(array $usersId, int $paginatePage = 1, string $orderByColumn = 'name'): LengthAwarePaginator
    {
        if($usersId !== []) {
            $userFullData = UserFullData::query()
                ->whereIn('user_id', $usersId)
                ->orderBy($orderByColumn)
                ->paginate($paginatePage);
        } else {
            $userFullData = UserFullData::query()->orderBy($orderByColumn)->paginate($paginatePage);
        }
        return $userFullData;
    }

    /**
     * @param Request $request
     * @param int $userID
     * @return bool
     */
    public function create(Request $request, int $userID): bool
    {
        $request->validate(self::RULES_FOR_VALIDATION);
        if(!User::query()->find($userID)) {
            return false;
        }
        $userData = new UserFullData();
        $userData->user_id = $userID;
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
        return true;
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request, $id): bool
    {
        $request->validate(self::RULES_FOR_VALIDATION);
        $userData = UserFullData::query()->find($id);
        if($userData) {
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
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $resultStatus = false;
        $userData = UserFullData::query()->find($id);
        if($userData) {
            $userData->delete();
            $resultStatus = true;
        }
        return $resultStatus;
    }
}
