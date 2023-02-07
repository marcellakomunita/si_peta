@php
    $bgcolor = ['#F3EBF8', '#F8F3ED', '#F7F1F1', '#EDF5F8', '#F8F0EE'];
    // $icolor = ['#C359F9', '#FE9D1A', '#F57C71', '#45D3E6', '#19D3E5', '#F76C58']
@endphp

@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-56 md:pt-52">
    <div class="w-full">

        <div class="flex">
            <x-user.asidehome :categories="$categories"/>
            <div class="w-full">
                <!-- Jumbotron -->
                <div>
                {{-- <div class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover rounded-lg h-[250px] md:h-[400px] mt-4"> --}}
                    {{-- <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
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
                </div> --}}

                    <div id="default-carousel" class="relative" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                            <!-- Item 1 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <span class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                                <img src="{{ asset('images/jumbotrons') . '/' . $jumbotrons[0]->img_slide }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ asset('images/jumbotrons') . '/' . $jumbotrons[1]->img_slide }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ asset('images/jumbotrons') . '/' . $jumbotrons[2]->img_slide }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                        </div>
                        <!-- Slider indicators -->
                        <div class="absolute z-20 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        </div>
                        <!-- Slider controls -->
                        <button type="button" class="absolute top-0 left-0 z-20 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute top-0 right-0 z-20 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>

                </div>
                <!-- Jumbotron -->

                <!-- Categories -->
                <div class="mx-auto py-8 lg:hidden">
                    <div class="flex justify-between items-center">
                        <h2 class="my-2 text-2xl md:text-3xl text-gray-900 font-silk tracking-wide">Kategori</h2>
                        <a href="{{ route('user.books.search') }}">
                            <p class="text-xs text-gray-800 hover:text-red-500">Lihat semua</p>
                        </a>
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-y-10 gap-x-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-5 xl:gap-x-8">
                        @foreach($categories as $key => $category)
                        <div class="group relative">
                            <div class="flex flex-col justify-between h-full max-w-sm py-4 rounded-lg text-gray-800">
                                <a href="{{ route('user.books.search', ['category' => $category->id]) }}">
                                    <div class="">
                                        <img src="{{ asset('images/icon') . '/' . strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.' . substr( strrchr($category->img_icon, '.'), 1) }}" alt="icon" class="w-16 h-16">
                                        <h5 class="mt-3 font-semibold text-base text-gray-800">{{ $category->name }}</h5>
                                    </div>
                                </a>
                                <div>
                                {{-- <a href="{{ route('user.books.search', ['category' => $category->id]) }}" class="text-xs inline-flex items-center text-red-600 hover:underline">
                                    Lihat buku >
                                </a> --}}
                            </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <!-- Categories -->

                <!-- Ebook Favorit -->
                <div class="mx-auto py-8">
                    <div class="flex justify-between items-center">
                        <h2 class="my-2 text-2xl md:text-3xl text-gray-900 font-silk tracking-wide">Ebook Favorit</h2>
                        <a href="{{ route('user.books.search', ['based_on'=>'most-favorite']) }}">
                            <p class="text-xs text-gray-800 hover:text-red-500">Lihat semua</p>
                        </a>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                        @foreach($favorite_books as $book)
                        <div class="group relative rounded-t-xl">
                            <div class="">
                                <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-md group-hover:opacity-75 lg:aspect-none lg:h-60">
                                    <img src="{{ $book->img_cover ? route('content.cover', ['id'=>$book->img_cover]) : asset('images/nocover.png')}}" alt="cover-buku" class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
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
                <!-- Ebook Favorit -->

                <!-- Ebook Latest -->
                <div class="mx-auto py-8">
                    <div class="flex justify-between items-center">
                        <h2 class="my-2 text-2xl md:text-3xl text-gray-900 font-silk tracking-wide">Ebook Terbaru</h2>
                        <a href="{{ route('user.books.search', ['based_on'=>'latest']) }}">
                            <p class="text-xs text-gray-800 hover:text-red-500">Lihat semua</p>
                        </a>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                        
                        @foreach($latest_books as $book)
                        <div class="group relative rounded-t-xl">
                            <div class="">
                                <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-md group-hover:opacity-75 lg:aspect-none lg:h-60">
                                    <img src="{{ route('content.cover', ['id'=>$book->img_cover])}}" alt="cover-buku" class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
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
                <!-- Ebook Latest -->
            </div>
        </div>
    </div>
</div>
@endsection