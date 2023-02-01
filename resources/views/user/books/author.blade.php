@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40">
    <div class="w-full">
        <h2 class="text-2xl font-silk text-gray-900">Author: {{ $author[0]->name }}</h2>

        @if(count($books) > 0)
        <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
            @foreach($books as $book)
                <div class="group relative rounded-t-xl">
                    <div class="">
                        <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-60">
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
        
        @else
        <div class="my-4 bg-white rounded-md shadow-sm">
            <div class="py-24 flex flex-col items-center justify-center">
                No books found
            </div>
        </div>
        @endif
    </div>
</div>
@endsection