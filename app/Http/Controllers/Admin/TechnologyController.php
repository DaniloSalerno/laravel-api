<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderByDesc('id')->paginate(10);

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
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');
        //dd($val_data);
        Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');
        //dd($val_data);
        $technology->update($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {

        $projects = Project::withTrashed()->get();

        foreach ($projects as $project) {

            if ($project->technologies) {
                $project->technologies()->detach($technology->id);
            }
        }


        $technology->delete();

        return to_route('admin.technologies.index')->with('message', 'Welldone! Technology deleted successfully');
    }
}
