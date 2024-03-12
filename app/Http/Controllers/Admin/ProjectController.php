<?php

namespace App\Http\Controllers\Admin;

//importazione controller
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

//Form request
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

// Helpers per slug
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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

        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {   
        $projectData = $request->validated();
    
        $slug = Str::slug($projectData['name']);
        $projectData['slug']=$slug;

        //gestione inserimento immagini
        $imgPath = null;
        if (isset($projectData['thumb'])) {
            $imgPath = Storage::disk('public')->put('images', $projectData['thumb']);
        }
        //una volta aggiunta l'immagine alla cartella storage sostituisco il valore $projectData['thumb'] con il percorso
        $projectData['thumb'] = $imgPath;
        //fine gestione immagini

        $project = Project::create($projectData);
        //aggiungo la relazione sulla tabella pivot
        if (isset($projectData['technologies'])) {
            foreach ($projectData['technologies'] as $singleTechnologyId) {
      
                $project->technologies()->attach($singleTechnologyId);
            }
        }
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

        $technologies = Technology::all();

        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $projectData = $request->validated();
        //gestione modifica dell'immagine
        //setto una variabile di supporto con il percorso che ho salvato nel db
        $imgPath = $project->thumb;
        if (isset($projectData['thumb'])) {
            //entro in questa condizione se l'utente ha valorizzato il form thumb
            if ($project->thumb != null) {
                //entro qui per eliminare l'immagine nello storage perchè era valorizzata la colonna 
                //thumb con un percorso ciò significa che devo eliminare il vecchio dato
                Storage::disk('public')->delete($project->thumb);
            }
            //aggiungo l'immmagine all'interno dello storage nella cartella images
            $imgPath = Storage::disk('public')->put('images', $projectData['thumb']);
        }
        else if (isset($projectData['delete_img'])) {
            //se dall'input utente mi arriva la check di eliminare l'immagine del progetto la elimino dallo storage
            Storage::disk('public')->delete($project->thumb);
            //setto il path a null
            $imgPath = null;
        }
        $projectData['thumb'] = $imgPath;
        //fine gestione modifica dell'immagine
        
        $project->update($projectData);
        //modifico i dati nella tabella pivot
        if (isset($projectData['technologies'])) {
            $project->technologies()->sync($projectData['technologies']);
        }
        else {
            $project->technologies()->detach();
        }
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //controllo se la thumb è settata in caso elimino l'immagine in storage
        if ($project->thumb != null) {
            Storage::disk('public')->delete($project->thumb);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
