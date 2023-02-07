@extends('layouts.app')
   
@section('content')
<section class="bg-white flex items-center h-screen">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center flex flex-col items-center">
            <div>
                <img src="{{ asset('images/sipeta.png') }}" alt="logo" class="mb-8 w-32 h-32">
            </div>
            <h1 class="mb-4 text-4xl tracking-tight font-extrabold text-red-500">403</h1>
            {{-- <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl">Situs tidak dapat diakses.</p> --}}
            <p class="mb-4 text-lg font-light text-gray-500">You do not have permission to access for this page.</p>
            
            @if(!Auth::user())
                <a href="{{ route('login') }}"> 
                    <button class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
                </a>
            @elseif(Auth::user()->type == '1')
                <a href="{{ route('admin.dashboard') }}"> 
                    <button class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kembali ke Dashboard</button>
                </a>
            @elseif(Auth::user()->type == '0')
                <a href="{{ route('user.dashboard') }}"> 
                    <button class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kembali ke Home</button>
                </a>  
            @endif
        </div>   
    </div>
</section>
@endsection