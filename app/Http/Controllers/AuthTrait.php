<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    /**
     * @return array
     */
    public function getUsersListIdsIncludesAdmin(): array
    {
        $listUserIds = [];
        if((int) Auth::user()->user_type !== (int) $_ENV['USER_TYPE_ADMIN']) {
            $users = User::query()
                ->select('id')
                ->where('user_type', '=', $_ENV['USER_TYPE_ADMIN'])
                ->get();
            foreach ($users as $user) {
                $listUserIds[] = $user->id;
            }
            $listUserIds[] = Auth::user()->id;
        }
        return $listUserIds;
    }

    /**
     * @return array
     */
    public function getOnlyUsersListIds(): array
    {
        $listUserIds = [];
        if((int) Auth::user()->user_type !== (int) $_ENV['USER_TYPE_ADMIN']) {
            $listUserIds[] = Auth::user()->id;
        }
        return $listUserIds;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function checkAccessUser(Model $model): bool
    {
        if ((int) Auth::user()->user_type !== (int) $_ENV['USER_TYPE_ADMIN'] &&
            (int) $model->user_id !== (int) Auth::user()->id
        ) {
            return false;
        }
        return true;
    }

}
