<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'tech_stack' => 'nullable',
        ]);

        $project->update($validated);

        return redirect('/')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/')->with('success','Project berhasil dihapus.');
    }
}
