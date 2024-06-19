@extends('layouts.admin')

@section('content')
<div class="container">
    <section class="my-3">
        <h2>New Category</h2>
    </section>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form class="mt-3" action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category's Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="namehelper" placeholder="Insert your Category's Name here" value="{{old('name')}}" />
            <small id="namehelper" class="form-text text-muted">Type the Name for your Category</small>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn bg-app-primary">Create</button>

    </form>
</div>
@endsection