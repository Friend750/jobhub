@extends('layouts.app')
@section('Title', 'Unauthorized')

@section('content')
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <img src="{{ asset('images/unauthorized.png') }}" loading="lazy" alt="Hero Image" class="img-fluid custom-image w-100">
            </div>
            <div class="col-md-6">
                <div class="text-dark text-center" role="alert">
                    <h1 class="display-1">404</h1>
                    <h2>{{session('error')}}</h2>
                    <p>Sorry, the page you are looking for could not be found.</p>
                    <a href="{{ route('post') }}" class="btn btn-primary rounded">Go to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
