@php
    $bgcolor = ['bg-blue-200', 'bg-yellow-100', 'bg-teal-100', 'bg-indigo-200',  'bg-rose-200'];
@endphp

@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40" style="background-color: #f8f8f8">
    <div class="w-full">
        
        <!-- Jumbotron -->
        <div class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover rounded-lg"
            style="background-image: url('https://mdbcdn.b-cdn.net/img/new/slides/041.webp');
                height: 400px;">
            <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                style="background-color: rgba(0, 0, 0, 0.6)">
                <div class="flex justify-center items-center h-full">
                    <div class="text-white">
                        <h2 class="font-semibold text-4xl mb-4">Heading</h2>
                        <h4 class="font-semibold text-xl mb-6">Subheading</h4>
                        <a href="#!" role="button" data-mdb-ripple="true" data-mdb-ripple-color="light" class="inline-block px-7 py-3 mb-1 border-2 border-gray-200 text-gray-200 font-medium text-sm leading-snug uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                            Call to action
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->

        <!-- Categories -->
        <div class="mx-auto py-8">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Kategori</h2>
                <a href="{{ route('user.books.search') }}">
                    <p class="text-xs text-gray-800 hover:underline">Lihat semua</p>
                </a>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                @foreach($categories as $key => $category)
                <div class="group relative">
                    <div class="max-w-sm px-6 py-4 {{ $bgcolor[$key] }} rounded-lg">
                        {{-- <svg class="w-10 h-10 mb-2 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path><path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path></svg> --}}
                        <img src="{{ asset('images/icon') . '/' . strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.png' }}" alt="icon" class="w-10 h-10">
                        <h5 class="mt-3 mb-1 font-semibold tracking-tight text-gray-900">{{ $category->name }}</h5>
                        {{-- <p class="mb-3 font-normal text-gray-500">Go to this step by step guideline process on how to certify for your weekly benefits:</p> --}}
                        <a href="{{ route('user.books.search', ['category' => $category->id]) }}" class="text-xs inline-flex items-center text-blue-600 hover:underline">
                            Lihat buku >
                            {{-- <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path></svg> --}}
                        </a>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
        <!-- Categories -->

        <!-- e-Book Favorit -->
        <div class="mx-auto py-8">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">e-Book Favorit</h2>
                <a href="{{ route('user.books.search', ['based_on'=>'most-favorite']) }}">
                    <p class="text-xs text-gray-800 hover:underline">Lihat semua</p>
                </a>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                @foreach($favorite_books as $book)
                <div class="group relative rounded-t-xl">
                    <div class="">
                        <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-60">
                            <img src="{{ route('content.cover', ['id'=>'pMdzCGbsxhphw80B'])}}" alt="cover-buku" class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                    </div>
                    <div class="rounded-b-lg px-4 py-3 flex justify-between bg-white">
                        <div>
                            <h3 class="font-bold text-gray-700">
                            <a href="{{ route('user.books.book', ['id'=>$book->id]) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $book->judul }}
                            </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $book->penulis }}</p>
                        </div>
                        {{-- <p class="text-sm font-medium text-gray-900">$35</p> --}}
                    </div>
                </div>
                @endforeach
            
            </div>
        </div>
        <!-- e-Book Favorit -->

        <!-- e-Book Latest -->
        <div class="mx-auto py-8">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">e-Book Terbaru</h2>
                <a href="{{ route('user.books.search', ['based_on'=>'latest']) }}">
                    <p class="text-xs text-gray-800 hover:underline">Lihat semua</p>
                </a>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                
                @foreach($latest_books as $book)
                <div class="group relative rounded-t-xl">
                    <div class="">
                        <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-60">
                            <img src="{{ route('content.cover', ['id'=>'pMdzCGbsxhphw80B'])}}" alt="cover-buku" class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                    </div>
                    <div class="rounded-b-lg px-4 py-3 flex justify-between bg-white">
                        <div>
                            <h3 class="font-bold text-gray-700">
                                <a href="{{ route('user.books.book', ['id'=>$book->id]) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $book->judul }}
                            </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $book->penulis }}</p>
                        </div>
                        {{-- <p class="text-sm font-medium text-gray-900">$35</p> --}}
                    </div>
                </div>
                @endforeach
            
            </div>
        </div>
        <!-- e-Book Latest -->
    </div>
</div>
@endsection