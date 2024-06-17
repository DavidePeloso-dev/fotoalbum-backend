<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function categories()
    {
        return response()->json([
            'results' => Category::all()
        ]);
    }


    public function photos(Request $request)
    {
        if ($request->has('search') && $request->search != '') {

            if ($request->search == 'evidence') {
                return response()->json([
                    'results' => Photo::with(['category', 'user'])->orderByDesc('id')->where('evidence', 1)->paginate(),
                ]);
            }
            return response()->json([
                'results' => Photo::with(['category', 'user'])->orderByDesc('id')->where('category_id', $request->search)->paginate(),
            ]);
        }

        return response()->json([
            'results' => Photo::with(['category', 'user'])->orderByDesc('id')->paginate(),
        ]);
    }

    public function evidence()
    {
        return response()->json([
            'results' => Photo::where('evidence', 1)->with(['category', 'user'])->orderByDesc('id')->get(),
        ]);
    }

    public function about()
    {
        return response()->json([
            'results' => Photo::with(['category', 'user'])->orderBy('id')->limit(3)->get(),
        ]);
    }
}
