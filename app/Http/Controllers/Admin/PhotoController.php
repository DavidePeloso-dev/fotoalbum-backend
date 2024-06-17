<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Photo::all());
        return view('admin.photos.index', ['photos' => Photo::where('user_id', auth()->id())->orderByDesc('id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        //dd($request->all());
        $validated = $request->validated();
        if (isset($validated['image'])) {
            $validated['image'] = Storage::put('uploads', $validated['image']);
        }

        $validated['slug'] = Str::slug($validated['title'], '-');
        $validated['user_id'] = auth()->id();

        //dd($validated);
        Photo::create($validated);
        return to_route('admin.photos.index')->with('message', 'Congratulation Photo added Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        if ($photo->user_id != auth()->id()) {
            abort(403, "Why do you wanna see it here? Go whatch it on the front end, dumbass!");
        }
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        if ($photo->user_id != auth()->id()) {
            abort(403, "You Can'T Edit Photos that are NOT Yours!");
        }
        $categories = Category::all();
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {

        $validated = $request->validated();

        if ($request->has('image')) {
            if ($photo->image) {
                Storage::delete($photo->image);
            }

            $validated['image'] = Storage::put('uploads', $request->image);
        }
        if (!$request->has('evidence')) {
            $validated['evidence'] = 0;
        }

        $validated['slug'] = Str::slug($validated['title'], '-');

        //dd($validated);
        $photo->update($validated);
        return to_route('admin.photos.index')->with('message', 'Congratulation Photo updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        if ($photo->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Photos that are NOT Yours!");
        }
        if ($photo->image && !Str::startswith($photo->image, 'https://')) {
            Storage::delete($photo->image);
        }

        $photo->delete();
        return to_route('admin.photos.index')->with('message', 'Congratulation Photo deleted correctly!');
    }
}
