<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'technologies' => Technology::with('projects')->orderByDesc('id')->paginate(20)
        ]);
    }

    public function show($slug)
    {
        $technology = Technology::with('projects')->where('slug', $slug)->first()->projects()->paginate(8);
        //dd($technology);
        if ($technology) {
            return response()->json([
                'success' => true,
                'result' => $technology
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Page not found'
            ]);
        }
    }
}
