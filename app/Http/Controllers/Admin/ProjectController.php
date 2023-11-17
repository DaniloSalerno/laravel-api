<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);

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
        $val_data = $request->validated();

        $val_data['slug'] = Project::generateSlug($request->title);

        //dd($val_data);

        if ($request->has('thumb')) {
            $file_path = Storage::disk('public')->put('projects_images', $request->thumb);
            $val_data['thumb'] = $file_path;
        }

        $project = Project::create($val_data);
        $project->technologies()->attach($request->technologies);
        return to_route('admin.projects.index')->with('message', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        if ($project) {
            return view('admin.projects.show', compact('project'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $thumb = $project->thumb;
        //dd($thumb);
        $relative_path = Str::after($thumb, 'storage/');

        if ($request->has('thumb') && $project->thumb) {

            Storage::delete($relative_path);

            $newImageFile = $request->thumb;

            $file_path = Storage::put('projects_images', $newImageFile);
            $val_data['thumb'] = $file_path;
        }

        if (!Str::is($project->getOriginal('title'), $request->title)) {
            $val_data['slug'] = $project->generateSlug($request->title);
        }

        $project->update($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        }

        return to_route('admin.projects.index')->with('message', 'Welldone! project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        //dd($project->exif_thumbnail);
        //dd($project->thumb);
        /*  if (!is_null($project->thumb)) {
            Storage::delete($project->thumb);
        } */

        $project->delete();

        return to_route('admin.projects.index')->with('message', 'Welldone! Project deleted successfully');
    }

    public function trash_projects()
    {
        return view('admin.projects.trash', ['trash_project' => Project::onlyTrashed()->orderByDesc('deleted_at')->paginate(10)]);
    }


    public function restore($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->restore();

        return to_route('admin.projects.index')->with('message', 'Welldone! Project restored successfully');
    }

    public function forceDelete($id)
    {
        $project = Project::withTrashed()->find($id);
        $thumb = $project->thumb;

        $relative_path = Str::after($thumb, 'storage/');



        if (!is_null($project->thumb)) {
            //dd($project->thumb);
            //dd(Storage::exists($relative_path));
            Storage::delete($relative_path);
        }

        if ($project->technologies) {
            $project->technologies()->detach();
        }

        $project->forceDelete();

        return to_route('admin.trash')->with('message', 'Well Done! Project deleted successfully!');
    }
}
