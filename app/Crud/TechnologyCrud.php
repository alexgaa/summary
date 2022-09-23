<?php

declare(strict_types=1);

namespace App\Crud;

use App\Models\Technology;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class TechnologyCrud
{
    private const RULES_FOR_VALIDATION = ['name' => 'required|min:2|max:255'];

    /**
     * @param array $usersId
     * @param int $paginatePage
     * @param string $orderByColumn
     * @return LengthAwarePaginator
     */
    public function read(array $usersId, int $paginatePage = 5, string $orderByColumn = 'name'): LengthAwarePaginator
    {
        if($usersId !== []) {
            $technology = Technology::query()->
            whereIn('user_id', $usersId)->
            orderBy($orderByColumn)->paginate($paginatePage);
        } else {
            $technology = Technology::query()->orderBy($orderByColumn)->paginate($paginatePage);
        }
        return $technology;
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
        $technology = new Technology();
        $technology->user_id = $userID;
        $technology->name = $request->name;
        $technology->comment = $request->comment;
        $technology->save();
        return true;
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request, $id): bool
    {
        $technology = Technology::query()->find($id);
        if($technology) {
            $request->validate(self::RULES_FOR_VALIDATION);
            $technology->name = $request->name;
            $technology->comment = $request->comment;
            $technology->save();
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
        $technology = Technology::query()->find($id);
        if($technology) {
            $technology->delete();
            $resultStatus = true;
        }
        return $resultStatus;
    }
}
