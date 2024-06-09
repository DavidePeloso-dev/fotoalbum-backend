@extends('layouts.admin')

@section('content')
<div class="container">
    <section class="my-3 d-flex justify-content-between align-items-center">
        <h2>Photos</h2>
        <div class="actions">
            <a class="nav-link" href="{{route('admin.photos.create')}}">
                <i class="fa-solid fa-circle-plus"></i>
                {{__('Add Photo')}}
            </a>
        </div>
    </section>

    <div class="table-responsive-md">
        <table class="table table-striped table-hover table-borderless table-secondary align-middle">
            <thead class="table-dark">
                <caption>
                    Photos
                </caption>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>In Evidence</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse($photos as $photo)
                <tr class="table-dark">
                    <td scope="row">{{$photo->id}}</td>
                    <td>
                        @if(Str::startsWith($photo->photo, 'https://'))
                        <img style="width: 150px;" loading="lazy" src="{{$photo->photo}}" alt="">
                        @else
                        <img style="width: 150px;" loading="lazy" src="{{asset('storage/' . $photo->photo)}}" alt="">
                        @endif
                    </td>
                    <td>{{$photo->title}}</td>
                    <td>
                        <div class="form-check ">
                            <input class="form-check-input ms-3" type="checkbox" value="" disabled {{$photo->evidence === 1 ? 'checked' : ''}} />
                        </div>
                    </td>
                    <td>View|Edit|Delete</td>
                </tr>
                @empty
                <tr class="table-dark">
                    <td scope="row">No Photos yet!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>
@endsection