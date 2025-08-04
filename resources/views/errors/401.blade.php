@extends('layouts.app')

@section('title', 'Error 401')

@section('content')
    <div class="text-center mt-5">
        <h1 class="display-1">401</h1>
        <p class="lead">Something went wrong (Error 401).</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
    </div>
@endsection
