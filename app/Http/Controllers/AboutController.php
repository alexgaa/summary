<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Crud\CategoryCrud;


class AboutController extends Controller
{
    public function index()
    {
        $categoryCrud = new CategoryCrud();
        $categories = $categoryCrud->read();

        return view('about', compact('categories'));
    }
}
