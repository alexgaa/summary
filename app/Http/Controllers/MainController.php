<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $technologies = DB::table('experiences')
            ->select('experiences.id',
                'experience_technology.priority',
                'technologies.name as technology_name')
            ->join('experience_technology',
                'experience_technology.experience_id',
                '=', 'experiences.id')
            ->join('technologies',
                'experience_technology.technology_id',
                '=', 'technologies.id')
            ->orderBy('experience_technology.priority')
            ->get();

        $works = DB::table('experiences')
            ->select('experiences.id',
                'experience_work.priority',
                'works.name as work_name',
                'works.description')
            ->join('experience_work',
                'experience_work.experience_id',
                '=', 'experiences.id')
            ->join('works',
                'experience_work.work_id',
                '=', 'works.id')
            ->orderBy('experience_work.priority')
            ->get();

        $experiences = DB::table('experiences')
            ->orderByDesc('experiences.start_date')
            ->get();


//        $technology = new Technology();
//        $technology->name = 'Mysql2';
//        $technology->save();
//        $experience = new Experience();
//        $experience->start_date = date('Y-m-d');
//        $experience->position = "Программист4";
//        $experience->save();
//
//        $experience->technologies()->attach($technology);


        return view('main.index', compact('experiences', 'technologies', 'works'));
    }
}
