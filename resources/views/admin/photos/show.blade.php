@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="containe">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col p-5 d-flex justify-content-center">
                <div class="card w-75 glass p-3">
                    @if(Str::startsWith($photo->image, 'https://'))
                    <img style="width: 100%;" loading="lazy" src="{{$photo->image}}" alt="">
                    @else
                    <img style="width: 100%;" loading="lazy" src="{{asset('storage/' . $photo->image)}}" alt="">
                    @endif
                </div>
            </div>

            <div class="col p-5">
                <div class="card w-75 glass p-3">
                    <div class="card-body">
                        <h2 class="card-title">{{$photo->title}}</h2>
                        @if($photo->description)
                        <p class="card-text">{{$photo->description}}</p>
                        @else
                        <p class="card-text">Photo's description coming Soon</p>
                        @endif
                    </div>
                    <div class="d-flex p-3">
                        <span class="badge fs-6 badge-accent">{{$photo->category->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection