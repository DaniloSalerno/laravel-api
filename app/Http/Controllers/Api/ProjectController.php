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
            'status' => 'success',
            'result' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(10)
        ]);
    }

    public function types()
    {
        return response()->json([
            'status' => 'success',
            'result' => Type::with('projects')->orderByDesc('id')->paginate(10)
        ]);
    }

    public function technologies()
    {
        return response()->json([
            'status' => 'success',
            'result' => Technology::with('projects')->orderByDesc('id')->paginate(10)
        ]);
    }
}
