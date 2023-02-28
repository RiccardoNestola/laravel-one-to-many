<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    protected $rules =
    [
        'title' => 'required|string|min:2|max:200',
        'description' => 'required|min:2|max:600',
        'category' => 'required|min:2|max:100',
        'year' => 'required|integer|between:1950,2023',
        'technology_used' => 'min:2',
        'thumb' => 'required|image',
        'date_added' => 'required|string|min:2|max:200',

    ];

    protected $messages = [

        'title.required' => 'E\' necessario inserire un titolo',
        'title.min' => 'Il titolo deve contenere almeno 2 caratteri',
        'title.max' => 'Il titolo non può essere più lungo 200',

        'description.required' => 'E\' necessario inserire una descrizione',
        'description.min' => 'La descrizione deve contenere almeno 2 caratteri',
        'description.max' => 'La descrizione non può essere più lunga di 600 caratteri',

        'category.required' => 'Inserisci una almeno una categoria',
        'category.min' => 'Il numero di caratteri deve essere almeno di due',

        'year.required' => 'Inserisci un anno corretto',

        'technology_used.min' => 'Il numero di caratteri deve essere almeno di due',

        'thumb.required' => 'Inserisci un link per la tua immagine',
        'thumb.image' => 'Inserisci un immagine valida',

        'date_added' => 'Insierisci una data'
        
    ];




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('date_added', 'DESC')->paginate(20);
        /* $projects = Project::paginate(20); */
        return view( "admin.projects.index",  compact("projects"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $formData = $request->all();
        $request->validate($this->rules, $this->messages);
        $newProject = new Project();
        $newProject->fill($formData);
        $newProject -> thumb = Storage::put('uploads', $formData["thumb"]);

        $newProject->save();

        return redirect()->route("admin.projects.show", $newProject->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
       /*  dd($project); */
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        
        $formData = $request->validate($this->rules, $this->messages);
        /* $project = Project::findOrFail($id); */


        if ($request->hasFile('thumb')) {

            if (!$project->isImageAUrl()) {
                Storage::delete($project->thumb);
            }
        }


        $formData["thumb"] = Storage::put('uploads', $formData["thumb"]);
        $project->update($formData);

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    
    {
        /* Storage::delete($project->thumb); */

       /*  if ($project->thumb) {
            Storage::delete($project->thumb);
        } */

        $project->delete();

        return redirect()->route('admin.projects.index')->with('alert-message', "Spostato nel cestino")->with('alert-type', 'success');
    }



    /**
     * Display a listing of trashed resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(/* Project $project */)
    {
        
        $projects = Project::onlyTrashed()->paginate(10);
        return view('admin.projects.trashed', compact('projects'));
    }


    /**
     *  Restore project data
     * 
     * @param Project $projects
     * 
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Project::where('id', $id)->withTrashed()->restore();
        return redirect()->route('admin.projects.index')->with('alert-message', "Ripristinato con successo")->with('alert-type', 'success');
    }

    /**
     * Force delete project data
     * 
     * @param Project $projects
     * 
     * @return \Illuminate\Http\Response
     */
    public function forceDelete( $id)
    
    {
        $project = Project::withTrashed()->find($id);
        $project->forceDelete();


        if (!$project->isImageAUrl()) {
            Storage::delete($project->thumb);
        }


        /* Project::where('id', $id)->withTrashed()->forceDelete(); */
        return redirect()->route('admin.projects.trashed')->with('alert-message', "Cancellato definitivamente")->with('alert-type', 'success');
    }


    /**
     * Restore all archived projects
     * 
     * @return \Illuminate\Http\Response
     */
    public function restoreAll()
    {
        Project::onlyTrashed()->restore();
        return redirect()->route('admin.projects.index')->with('alert-message', "Tutti i progetti sono stati ripristinati")->with('alert-type', 'success');
    }


}


    