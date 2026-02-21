<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        /** Phase 3.5 - Step 1
        // // Blok kode berikut membuat Backend langsung kirim HTML (tampilan)
        // $projects = Project::all();
        // return view('portofolio', compact('projects'));

        // Blok kode berikut membuat Backend kirim DATA (JSON), bukan tampilan
        $projects = Project::latest()->get();
        return ProjectResource::collection($projects);
        */

        /** Phase 3.5 - Step 2
         *  ======================
         *  GET /api/projects
         *  ======================
        $projects = Project::latest()->get();
        return ProjectResource::collection($projects)
            ->response()
            ->setStatusCode(200);
        */

        /** Phase 3.5 - Step 3
         *  Upgrade: Pagination
         *  Fungsi Pagination membagi data menjadi halaman
        */
        $projects = Project::latest()->paginate(5);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Project berhasil diambil',
            'data' => ProjectResource::collection($projects),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ]
        ], 200);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  GET /api/projects/{id}
     *  ======================
    */
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project tidak ditemukan.'
            ], 404);
        }

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(200);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  POST /api/projects
     *  ======================
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'tech_stack' => 'nullable'
        ]);

        $project = Project::create($validated);

        // return (new ProjectResource($project))
        //     ->response()
        //     ->setStatusCode(201); // Created

        return response()->json([
            'message' => 'Project berhasil dibuat',
            'data' => new ProjectResource($project)
        ], 201);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  PUT /api/projects/{id}
     *  ======================
    */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'tech_stack' => 'nullable'
        ]);

        $project->update($validated);

        // return (new ProjectResource($project))
        //     ->response()
        //     ->setStatusCode(200);

        return response()->json([
            'message' => 'Project berhasil di-update',
            'data' => new ProjectResource($project)
        ], 200);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  DELETE /api/projects/{id}
     *  ======================
    */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project tidak ditemukan.'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'message' => 'Project berhasil dihapus.'
        ], 200);
    }
}
