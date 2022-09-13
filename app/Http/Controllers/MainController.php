<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Technology;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
//        $technology = new Technology();
//        $technology->name = 'Mysql2';
//        $technology->save();
//        $experience = new Experience();
//        $experience->start_date = date('Y-m-d');
//        $experience->position = "Программист4";
//        $experience->save();
//
//        $experience->technologies()->attach($technology);


        return view('main.index');
    }
}
