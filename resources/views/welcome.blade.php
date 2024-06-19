@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-dark">
    <div class="container py-5">
        <div class="logo_laravel">

        </div>
        <h1 class="display-5 fw-bold">
            Welcome to <strong class="app-primary">Jhon Dho</strong> gestional Portfolio
        </h1>

        <p class="col-md-8 fs-4">
            This is a gestional application for the photograper. <br>
            You probably should't have to be here.
            Go see the guest Application whith the button below. <br>
            Let's press It Now<i class="bi bi-arrow-down"></i>
        </p>
        <a href="http://localhost:5173/" target="_blank" class="btn btn-app bg-accent btn-lg" type="button">See the Portfolio</a>
    </div>
</div>

<div class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>
@endsection