<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function technologies()
    {
        return response()->json([
            'success' => true,
            'technologies' => Technology::with('projects')->orderByDesc('id')->paginate(20)
        ]);
    }
}
