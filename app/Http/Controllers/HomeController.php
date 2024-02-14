<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */

    public function index()
    {
        $projects = Project::all();
        $partners = Partner::all();
        return view('home.home', compact("projects", "partners"));
    }





}
