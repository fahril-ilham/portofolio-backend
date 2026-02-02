<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Symfony\Component\HttpFoundation\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('portofolio', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'tech_stack' => 'nullable'
        ]);

        // Eloquent ORM, Mass Assignment
        Project::create($validated);

        return redirect('/')->with('success', 'Project berhasil ditambahkan.');
    }
}
