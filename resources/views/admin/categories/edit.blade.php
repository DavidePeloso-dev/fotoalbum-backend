@extends('layouts.admin')

@section('content')
<div class="container">
    <section class="my-3">
        <h2>New Category</h2>
    </section>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form class="mt-3" action="{{route('admin.categories.update', $category)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">category's Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="namehelper" placeholder="Insert your category's Name here" value="{{old('name', $category->name)}}" />
            <small id="namehelper" class="form-text text-muted">Type the Name for your category</small>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

    </form>
</div>
@endsection