
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
                <img src="{{ $book->img_cover ? route('content.cover', ['id'=>$book->id, 'ext'=>substr( strrchr($book->img_cover, '.'), 1)]) : asset('images/nocover.png')}}" alt="cover-buku" class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
            </div>
        </div>
        <div class="rounded-b-lg px-4 py-3 flex justify-between bg-white">
            <div>
                <h3 class="font-bold text-gray-700">
                <a href="{{ route('user.books.book', ['id'=>$book->id]) }}">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ $book->judul }}
                    <p>{{ $book->number_of_reads }}</p>
                </a>
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ $book->penulis }}</p>
            </div>
            {{-- <p class="text-sm font-medium text-gray-900">$35</p> --}}
        </div>
    </div>
    @endforeach
    @endif
</div>