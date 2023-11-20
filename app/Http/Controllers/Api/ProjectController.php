<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projects()
    {
        return response()->json([
            'success' => true,
            'result' => Project::with(['type', 'technologies'])->orderByDesc('id')->paginate(10)
        ]);
    }

    public function latestProjects()
    {
        return response()->json([
            'success' => true,
            'result' => Project::with(['type', 'technologies'])->orderByDesc('id')->take(3)->get()
        ]);
    }

    public function show($slug)
    {
        $project = Project::with(['type', 'technologies'])->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'result' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Page not found'
            ]);
        }
    }
}
