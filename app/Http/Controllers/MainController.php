<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Crud\CategoryCrud;
use App\Crud\UserFullDataCrud;
use App\Models\Technology;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    use AuthTrait;
    public const DEFAULT_USER_ID = 1;

    /** @var UserFullDataCrud  */
    private $usersFullDataCrud;
    /** @var CategoryCrud  */
    private $categoryCrud;

    public function __construct()
    {
        $this->usersFullDataCrud = new UserFullDataCrud();
        $this->categoryCrud = new CategoryCrud();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $listUserIds = [];
        if(auth()->check() && (int) Auth::user()->user_type !== (int) $_ENV['USER_TYPE_ADMIN']) {
            $listUserIds = $this->getOnlyUsersListIds();
        } else {
            $listUserIds[] = self::DEFAULT_USER_ID;
        }

        $categories = $this->categoryCrud->read();
        $technology = new Technology();
        $technologies = $technology->selectExperienceWithTechnology($listUserIds);
        $work = new Work();
        $works = $work->selectExperienceWithWork($listUserIds);

        $usersFullData = $this->usersFullDataCrud->read($listUserIds);

        $userFullData = $usersFullData[0];

        return view('main.index', compact('userFullData', 'technologies', 'works', 'categories'));
    }
}
