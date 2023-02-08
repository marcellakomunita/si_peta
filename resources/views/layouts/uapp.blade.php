@extends('layouts.app')
   
@section('content')
<x-user.navbar/>
<div class="flex overflow-hidden">
    <div id="main-content" class="h-full w-full relative overflow-y-auto">
        <main class="px-6 md:px-12 lg:px-20">
            @yield('sub-content')
        </main>

        <x-user.footer/>
    </div>
</div>
<div class="bottom-[40px] right-[40px] fixed z-30">
    <a href="https://wa.me/62895422559255" data-popover-target="popover-default" type="button" class="text-white bg-red-500 hover:bg-blredue-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-3 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
         </svg>
    </a>
    <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-48 text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg">
            <h3 class="font-semibold text-gray-900 ">Hubungi Admin Si Peta</h3>
        </div>
        <div class="px-3 py-2">
            <a href="https://wa.me/62895422559255">+62 8954-2255-9255</a>
        </div>
        <div data-popper-arrow></div>
    </div>
</div>
@endsection