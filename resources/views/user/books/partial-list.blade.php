
<div class="pt-3 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 xl:gap-x-8" id="content-books">
    @if(count($books) < 1)
    <div class="col-span-4 text-center py-24 bg-white rounded-md shadow-sm">
        No boooks found.
    </div>

    @else
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
                <p class="mt-1 mb-2 text-sm text-gray-500">{{ $book->penulis }}</p>
                <div class="flex items-center">
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-400 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye mr-1" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                             </svg>
                             {{ $book->number_of_reads }}
                        </p>
                    </div>
                    <div class="">
                        <p class="text-sm font-medium text-gray-400 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle-2 mr-1" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"></path>
                             </svg>
                             {{ $book->number_of_reviews }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>