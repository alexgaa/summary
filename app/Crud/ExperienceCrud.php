<?php

declare(strict_types=1);

namespace App\Crud;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ExperienceCrud
{
    private const RULES_FOR_VALIDATION = [
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
        'company_name' => 'required|max:255|min:2',
        'position' => 'required|max:100|min:2',
    ];

    /**
     * @param array $usersId
     * @param int $paginatePage
     * @param string $orderByColumn
     * @return LengthAwarePaginator
     */
    public function read(array $usersId, int $paginatePage = 0, string $orderByColumn = 'start_date'): LengthAwarePaginator
    {
        if($usersId !== []) {
            $experience = Experience::query()->
            whereIn('user_id', $usersId)->
            orderBy($orderByColumn)->paginate($paginatePage);
        } else {
            $experience = Experience::query()->orderBy($orderByColumn)->paginate($paginatePage);
        }
        return $experience;
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
        $experience = new Experience();
        $experience->user_id = $userID;
        $experience->start_date = $request->start_date;
        $experience->end_date = $request->end_date;
        $experience->position  = $request->position;
        $experience->company_name  = $request->company_name;
        $experience->save();
        $experience->technologies()->attach($request->technologies);
        $experience->works()->attach($request->works);
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
        $experience = Experience::query()->find($id);
        if($experience) {
            $experience->start_date = $request->start_date;
            $experience->end_date = $request->end_date;
            $experience->position  = $request->position;
            $experience->company_name  = $request->company_name;
            $experience->save();
            $experience->technologies()->sync($request->technologies);
            $experience->works()->sync($request->works);
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
        $experience = Experience::query()->find($id);
        if($experience) {

            $experience->technologies()->sync([]);
            $experience->works()->sync([]);
            $experience->delete();
            $resultStatus = true;
        }
        return $resultStatus;
    }
}
