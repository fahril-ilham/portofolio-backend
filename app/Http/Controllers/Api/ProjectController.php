<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
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

        // Phase 5.2 - Filtering, Search, Sorting (Real-World API)
        $query = Project::query();

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by tech_stack
        if ($request->filled('tech_stack')) {
            /** WHERE tech_stack = PHP, Bootstrap
             * nilai harus sama persis

            $query->where('tech_stack', $request->tech_stack);
            */

            /** WHERE tech_stack LIKE "%PHP%"
             * filter lebih fleksibel
            */
            $query->where('tech_stack', 'like', '%' . $request->tech_stack . '%');
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } else {
                $query->latest();
            }
        } else {
            $query->latest(); // default
        }

        $perPage = (int) $request->get('per_page', 3);

        // Batasi maksimal (biar tidak overload)
        if ($perPage <= 0) $perPage = 3;
        if ($perPage > 5) $perPage = 5;

        $projects = $query->paginate($perPage)->appends($request->query());

        return response()->json([
            'success' => true,
            'message' => 'Daftar project berhasil diambil.',
            'data' => ProjectResource::collection($projects),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
                'from' => $projects->firstItem(),
                'to' => $projects->lastItem(),
            ],
            'links' => [
                'first' => $projects->url(1),
                'last' => $projects->url($projects->lastItem()),
                'prev' => $projects->previousPageUrl(),
                'next' => $projects->nextPageUrl(),
            ]
        ], 200);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  GET /api/projects/{id}
     *  ======================
    */
    public function show(Project $project)
    {
        /** Phase 3.5 - Step 3
         *  Upgrade: Route Model Binding
         *  Fungsi: Ambil data berdasarkan ID di URL, jika tidak ada otomatis 404
        */
        return response()->json([
            'success' => true,
            'message' => 'Detail project berhasil diambil.',
            'data' => new ProjectResource($project)
        ], 200);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  POST /api/projects
     *  ======================
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string|max:255'
        ]);

        $project = Project::create($validated);

        /** Phase 3.5 - Step 3
         *  Upgrade: Response format standar
         *  Fungsi:
         *      Supaya frontend tahu:
         *      - Apakah request berhasil?
         *      - Pesan apa yang ditampilkan?
         *      - Data apa yang dipakai?
         */
        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dibuat.',
            'data' => new ProjectResource($project)
        ], 201);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  PUT /api/projects/{id}
     *  ======================
    */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string|max:255'
        ]);

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil diperbarui.',
            'data' => new ProjectResource($project)
        ], 200);
    }

    /** Phase 3.5 - Step 2
     *  ======================
     *  DELETE /api/projects/{id}
     *  ======================
    */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dihapus.'
        ], 200);
    }
}
