@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="containe">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col text-center  py-5 justify-content-center">
                <h2 class="badge fs-2 badge-accent">{{$category->name}}</h2>
            </div>

            <div class="col p-5">
                <h3>Category's Photos</h3>
                @foreach($category->photos as $photo)
                <div class="card flex-row gap-3 glass p-3 mb-3">
                    <div>
                        @if(Str::startsWith($photo->image, 'https://'))
                        <img style="width: 150px;" class="d-block show" loading="lazy" src="{{$photo->image}}" alt="">
                        @else
                        <img style="width: 150px;" class="d-block show" loading="lazy" src="{{asset('storage/' . $photo->image)}}" alt="">
                        @endif
                    </div>
                    <h4 class="card-title">{{$photo->title}}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection