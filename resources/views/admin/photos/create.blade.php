@extends('layouts.admin')

@section('content')
<div class="container">
    <section class="my-3">
        <h2>New Photo</h2>
    </section>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form class="mt-3" action="{{route('admin.photos.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Photo's Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="titlehelper" placeholder="Insert your Photo's Title here" value="{{old('title')}}" />
            <small id="titlehelper" class="form-text text-muted">Type the title for your Photo</small>
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="mb-3 w-75">
                <label for="image" class="form-label">Choose file</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="" aria-describedby="imagehelper" />
                <div id="imagehelper" class="form-text">Upload your Photo</div>
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="evidence" name="evidence" />
                <label class="form-check-label" for="evidence"> I want It in Evidence </label>
                @error('evidence')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Type the description for your Photo">{{old('description')}}</textarea>
            @error('description')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>

    </form>
</div>
@endsection