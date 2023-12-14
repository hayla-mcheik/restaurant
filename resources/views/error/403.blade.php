@extends('layouts.admin.master')
@section('title')
Error
@endsection
@section('content')
<div class="row justify-content-center vh-100 align-items-center">
    <div class="col-lg-6">
        <div class="text-center mt-4">
            <h1 class="display-1">401</h1>
            <p class="lead">Unauthorized</p>
            <p>Access to this resource is denied.</p>


            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left mr-1"></i>
                Return to Login
            </a>
        </div>
    </div>
</div>

@endsection