@extends('layouts.app')
   
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
   
                <div class="card-body">
                    You are a Admin User.
                </div>
            </div>
        </div>
    </div>
</div> --}}
<x-admin.navbar/>
<div class="flex overflow-hidden bg-white pt-16">
    <x-admin.sidebar/>
    <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
        <main>
            @yield('sub-content')
        </main>

        <x-admin.footer/>
    </div>
    </div>
@endsection