<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Crud\ExperienceCrud;
use App\Crud\TechnologyCrud;
use App\Crud\UserFullDataCrud;
use App\Crud\WorkCrud;
use App\Models\Experience;
use App\Models\Technology;
use App\Models\UserFullData;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    use AuthTrait;
    public const DEFAULT_USER_ID = 1;

    /** @var UserFullDataCrud  */
    private $usersFullDataCrud;

    public function __construct()
    {
        $this->usersFullDataCrud = new UserFullDataCrud();
    }

    public function index()
    {
        $listUserIds = [];
        if(auth()->check()) {
            $listUserIds = $this->getOnlyUsersListIds();
        } else {
            $listUserIds[] = self::DEFAULT_USER_ID;
        }

        $technology = new Technology();
        $technologies = $technology->selectExperienceWithTechnology($listUserIds);
        $work = new Work();
        $works = $work->selectExperienceWithWork($listUserIds);

        $usersFullData = $this->usersFullDataCrud->read($listUserIds);

        $userFullData = $usersFullData[0];

        return view('main.index', compact('userFullData', 'technologies', 'works'));
    }
}
