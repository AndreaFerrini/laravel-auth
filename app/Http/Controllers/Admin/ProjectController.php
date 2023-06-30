<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view( "admin.projects.index", compact("projects") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( "admin.projects.create" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // $request->validate(
        //     [
        //         "title" => "required|unique:projects|max:50",
        //     ],
        //     [
        //         "title.required" => "Il campo titolo è obbligatorio",
        //         "title.unique" => "Il campo titolo è già esistente",
        //         "title.max" => "Il campo titolo non deve superare i 50 caratteri"
        //     ]
        //     );

        // $form_data = $request->all();

        $form_data = $request->validated();


        $slug = Project::generateSlug($request->title);

        $form_data["slug"] = $slug;

        if( $request->hasFile("cover_image") ){

            $path = Storage::disk("public")->put( "project_image", $request->cover_image );
            $form_data["cover_image"] = $path;
        }

        $new_project = Project::create($form_data);

        return redirect()->route("admin.projects.index");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view ( "admin.projects.show", compact("project") );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view( "admin.projects.edit", compact("project") );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // $request->validate(
        //     [
        //         "title" => "required|unique:projects|max:50",
        //     ],
        //     [
        //         "title.required" => "Il campo titolo è obbligatorio",
        //         "title.unique" => "Il campo titolo è già esistente",
        //         "title.max" => "Il campo titolo non deve superare i 50 caratteri"
        //     ]
        //     );

        // $form_data = $request->all();

        $form_data = $request->validated();


        $slug = Project::generateSlug($request->title);

        $form_data["slug"] = $slug;

        if( $request->hasFile("cover_image") ){

            if( $project->cover_image){
                Storage::delete($project->cover_image);
            }
        

            $path = Storage::disk("public")->put( "project_image", $request->cover_image );
            $form_data["cover_image"] = $path;
        }

        $project->update( $form_data );

        return redirect()->route("admin.projects.index")->with("success", "Il project è stato modificato: $project->title");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
    
        if( $project->cover_image){
            Storage::delete($project->cover_image);
        }
    
        $project->delete();
        return redirect()->route("admin.projects.index");
    }
}