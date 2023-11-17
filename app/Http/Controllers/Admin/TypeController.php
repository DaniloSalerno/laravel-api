<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->paginate(10);

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {

        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');
        //dd($val_data);
        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'Types created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');
        //dd($val_data);
        $type->update($val_data);

        return to_route('admin.types.index')->with('message', 'Types updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {

        $projects = Project::withTrashed()->get();

        foreach ($projects as $project) {

            $project->type()->dissociate();

            $project->save();
        }

        $type->delete();

        return to_route('admin.types.index')->with('message', 'Welldone! Types deleted successfully');
    }
}
