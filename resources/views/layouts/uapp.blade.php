@extends('layouts.app')
   
@section('content')
<x-user.navbar/>
<div class="flex overflow-hidden bg-white ">
    <div id="main-content" class="h-full w-full relative overflow-y-auto">
        <main>
            @yield('sub-content')
        </main>

        <x-user.footer/>
    </div>
</div>
@endsection