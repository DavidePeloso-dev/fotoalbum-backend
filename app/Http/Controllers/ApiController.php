<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function photos()
    {
        return response()->json([
            'results' => Photo::with(['category', 'user'])->orderByDesc('id')->paginate(),
        ]);
    }

    public function evidence()
    {
        return response()->json([
            'results' => Photo::where('evidence', 1)->with(['category', 'user'])->orderByDesc('id')->paginate(),
        ]);
    }

    public function about()
    {
        return response()->json([
            'results' => Photo::with(['category', 'user'])->orderBy('id')->limit(3)->get(),
        ]);
    }
}
