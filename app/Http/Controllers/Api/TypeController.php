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
}
