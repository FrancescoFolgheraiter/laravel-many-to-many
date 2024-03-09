<?php

namespace App\Http\Controllers\Admin;

//importazione controller
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//models
use App\Models\Technology;

//Form request
use App\Http\Requests\Technology\StoreRequest as StoreTechnologyRequest;
use App\Http\Requests\Technology\UpdateRequest as UpdateTechnolgyRequest;

// Helpers per slug
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $technologyData = $request->validated();
        
        $slug = Str::slug($technologyData['title']);
        $technologyData['slug']=$slug;
        $technology = Technology::create($technologyData);

        return redirect()->route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $technology = technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnolgyRequest $request, Technology $technology)
    {
        $technologyData = $request->validated();
        $technology->update($technologyData);
        return redirect()->route('admin.technologies.show', ['technology' => $technology->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index');
    }
}
