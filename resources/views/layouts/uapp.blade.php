@extends('layouts.app')
   
@section('content')
<x-user.navbar/>
<div class="flex overflow-hidden">
    <div id="main-content" class="h-full w-full relative overflow-y-auto">
        <main class="px-6 lg:px-20">
            @yield('sub-content')
        </main>

        <x-user.footer/>
    </div>
</div>
@endsection