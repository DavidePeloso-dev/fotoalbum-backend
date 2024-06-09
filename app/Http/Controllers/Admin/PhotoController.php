<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Photo::all());
        return view('admin.photos.index', ['photos' => Photo::orderByDesc('id')->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        //dd($request->all());
        $validated = $request->validated();
        if (isset($validated['photo'])) {
            $validated['photo'] = Storage::put('uploads', $validated['photo']);
        }

        //dd($validated);
        Photo::create($validated);
        return to_route('admin.photos.index')->with('message', 'Congratulation Photo added Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {

        $validated = $request->validated();

        if ($request->has('photo')) {
            if ($photo->photo) {
                Storage::delete($photo->photo);
            }

            $validated['photo'] = Storage::put('uploads', $request->photo);
        }
        if (!$request->has('evidence')) {
            $validated['evidence'] = 0;
        }

        //dd($validated);
        $photo->update($validated);
        return to_route('admin.photos.index')->with('message', 'Congratulation Photo updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
