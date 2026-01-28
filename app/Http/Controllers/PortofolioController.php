<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PortofolioController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('portofolio', compact('projects'));
    }
}
