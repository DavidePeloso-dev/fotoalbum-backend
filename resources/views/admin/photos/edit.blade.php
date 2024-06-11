@extends('layouts.admin')

@section('content')
<div class="container">
    <section class="my-3">
        <h2>New Photo</h2>
    </section>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form class="mt-3" action="{{route('admin.photos.update', $photo)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Photo's Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="titlehelper" placeholder="Insert your Photo's Title here" value="{{old('title', $photo->title)}}" />
            <small id="titlehelper" class="form-text text-muted">Type the title for your Photo</small>
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Photo's Category</label>
            <select class="form-select " name="category_id" id="category_id">
                <option selected disabled>Select Photo's Category</option>
                @foreach($categories as $category)
                <option {{ old("category_id", $photo->category_id) == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <h6 class="fw-normal">Current Photo</h6>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                @if(Str::startsWith($photo->image, 'https://'))
                <img style="width: 150px;" loading="lazy" src="{{$photo->image}}" alt="">
                @else
                <img style="width: 150px;" loading="lazy" src="{{asset('storage/' . $photo->image)}}" alt="">
                @endif
            </div>
            <div class="mb-3 w-75">
                <label for="image" class="form-label">Choose file</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="" aria-describedby="imagehelper" />
                <div id="imagehelper" class="form-text">Upload your Photo</div>
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="evidence" name="evidence" {{$photo->evidence === 1 ? 'checked' : '' }} />
            <label class="form-check-label" for="evidence"> I want It in Evidence </label>
            @error('evidence')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Type the description for your Photo">{{old('description', $photo->description)}}</textarea>
            @error('description')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

    </form>
</div>
@endsection