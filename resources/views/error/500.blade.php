@extends('layouts.admin.master')
@section('title')
Error
@endsection
@section('content')
<div class="row justify-content-center vh-100 align-items-center">
    <div class="col-lg-6">
        <div class="text-center mt-4">
            <h1 class="display-1">500</h1>
            <p class="lead">Internal Server Error</p>
            @php
                $dashboardUrl = '';
                switch (auth()->user()->role_as) {
                    case 1:
                        $dashboardUrl = url('admin/dashboard');
                        break;
                    case 2:
                        $dashboardUrl = url('manager/dashboard');
                        break;
                    case 3:
                        $dashboardUrl = url('user/dashboard');
                        break;
                    default:
                        break;
                }
            @endphp

            <a href="{{ $dashboardUrl }}">
                <i class="fas fa-arrow-left mr-1"></i>
                Return to Dashboard
            </a>
        </div>
    </div>
</div>

@endsection