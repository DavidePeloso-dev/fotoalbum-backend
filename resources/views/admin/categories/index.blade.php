@extends('layouts.admin')

@section('content')
<div class="container">
    <section class="my-3 d-flex justify-content-between align-items-center">
        <h2>Categories</h2>
        <div class="actions">
            <a class="nav-link" href="{{route('admin.categories.create')}}">
                <i class="fa-solid fa-circle-plus"></i>
                {{__('Add Category')}}
            </a>
        </div>
    </section>

    @include('partials.session-message')

    <div class="table-responsive-md">
        <table class="table table-striped table-hover table-borderless table-secondary align-middle">
            <caption>
                Categories
            </caption>
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Category name</th>
                    <th>Times in use</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse($categories as $category)
                <tr class="table-dark">
                    <td scope="row">{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{Count($category->photos)}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('admin.categories.show', $category)}}">View</a>
                        <a class="btn btn-secondary" href="{{route('admin.categories.edit', $category)}}">Edit</a>
                        @include('admin.categories.partials.delete-button')
                    </td>
                </tr>
                @empty
                <tr class="table-dark">
                    <td scope="row">No Categories yet!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>
@endsection