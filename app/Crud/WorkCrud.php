<?php

declare(strict_types=1);

namespace App\Crud;

use App\Models\User;
use App\Models\Work;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class WorkCrud
{
    private const RULES_FOR_VALIDATION = ['name' => 'required|min:2|max:255'];

    /**
     * @param array $usersId
     * @param int $paginatePage
     * @param string $orderByColumn
     * @return LengthAwarePaginator
     */
    public function read(array $usersId, int $paginatePage = 0, string $orderByColumn = 'name'): LengthAwarePaginator
    {
        if($usersId !== []) {
            $works = Work::query()->
            whereIn('user_id', $usersId)->
            orderBy($orderByColumn)->paginate($paginatePage);
        } else {
            $works = Work::query()->orderBy($orderByColumn)->paginate($paginatePage);
        }
        return $works;
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
        $work = new Work();
        $work->user_id = $userID;
        $work->name = $request->name;
        $work->description = $request->description;
        $work->save();
        return true;
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request, $id): bool
    {
        $work = Work::query()->find($id);
        if($work) {
            $request->validate(self::RULES_FOR_VALIDATION);
            $work->name = $request->name;
            $work->description = $request->description;
            $work->save();
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
        $work = Work::query()->find($id);
        if($work) {
            $work->experiences()->sync([]);
            $work->delete();
            $resultStatus = true;
        }
        return $resultStatus;
    }
}
