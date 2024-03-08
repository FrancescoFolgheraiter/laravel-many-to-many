<?php

namespace App\Http\Controllers\Admin;

//importazione controller
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Project;
use App\Models\Type;

//Form request
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

// Helpers per slug
use Illuminate\Support\Str;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {   
        $projectData = $request->validated();
    
        $slug = Str::slug($projectData['name']);
        $projectData['slug']=$slug;
        $project = Project::create($projectData);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $types = Type::all();

        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $projectData = $request->validated();
        $project->update($projectData);
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
