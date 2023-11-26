<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Type::with('projects')->orderByDesc('id')->paginate(20)
        ]);
    }

    public function show($slug)
    {
        $type = Type::with('projects')->where('slug', $slug)->first()->projects()->paginate(6);

        if ($type) {
            return response()->json([
                'success' => true,
                'result' => $type
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Page not found'
            ]);
        }
    }
}
