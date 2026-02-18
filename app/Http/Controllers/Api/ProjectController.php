<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        /** Blok kode berikut membuat Backend langsung kirim HTML (tampilan)
        $projects = Project::all();
        return view('portofolio', compact('projects'));
        */

        // Blok kode berikut membuat Backend kirim DATA (JSON), bukan tampilan
        $projects = Project::latest()->get();
        return ProjectResource::collection($projects);
    }
}
