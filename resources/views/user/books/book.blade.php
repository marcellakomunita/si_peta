@php
use Carbon\Carbon;
@endphp

@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-64 md:pt-52">
    <div class="w-full">
        <!-- component -->
        <section class="text-gray-700 body-font overflow-hidden">
            <div class="">
                <div class="mx-auto flex flex-wrap">
                    <img alt="ecommerce" class="lg:w-1/3 p-4 w-full object-cover object-center rounded border border-gray-200" src="{{ $book->img_cover ? route('content.cover', ['id'=>$book->img_cover]) : asset('images/nocover.png')}}" >
                    <div class="lg:w-1/2 w-full lg:pl-16 lg:py-6 mt-6 lg:mt-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $penulis }}</h2>
                        <h1 class="text-gray-900 text-3xl title-font font-medium my-1">{{ $book->judul }}</h1>
                        <div class="flex mb-4">
                            <span class="flex items-center">
                                @for($i=1; $i<=floor($book_rate); $i++)
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                @endfor

                                @for($i=floor($book_rate); $i<5; $i++)
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                @endfor
                                <span class="text-gray-600 ml-2">{{ floor($book_rate) . '/5 (' . count($reviews) . ' reviews | ' . $number_of_reads . ' read) ' }}</span>
                            </span>
                        </div>
                        <p class="leading-relaxed mb-4">{{ $book->sinopsis }}</p>
                        <div class="details">
                            <p class="mb-3 text-lg font-silk">Detail Ebook</p>
                            <div class="grid grid-cols-2 gap-3">
                                <p><span class="font-bold text-gray-400">ISBN</span><br>{{ $book->isbn }}</p>
                                <p><span class="font-bold text-gray-400">Penerbit</span><br>{{ $penerbit }}</p>
                                <p><span class="font-bold text-gray-400">Jumlah Halaman</span><br>312</p>
                                <p><span class="font-bold text-gray-400">Tanggal Terbit</span><br>{{ $book->tgl_terbit->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between pt-4 mt-4 border-t-2 border-gray-200">
                            <form action="{{ route('user.bookr.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="bid" value="{{ $book->id }}">
                                <input type="hidden" name="uid" value="{{ Auth::user() ? Auth::user()->id : Request()->session()->getId() }}">
                                <button type="submit" class="flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">
                                    {{-- <a href="{{ url('/bookr?id=') . $book->id }}">Baca</a> --}}
                                    Baca
                                </button>
                            </form>

                            @if(Auth::user())
                                @csrf
                                <button id="favorite-btn" data-item={{ $book->id }} class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center {{ $is_favorite ? "text-red-600" : "text-gray-500" }} ml-4">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                    </svg>
                                </button>
                            @else
                                <a href="{{ route('login') }}">
                                    <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center {{ $is_favorite ? "text-red-600" : "text-gray-500" }} ml-4">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                        </svg>
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- review column -->
        {{-- <h2 class="text-lg font-bold mb-6 pb-6 border-bottom border-gray-200">Review Buku</h2> --}}
        <div class="px-2 mt-16 border-top border-gray-200">
            <form action="{{ route('user.books.reviews.store') }}" method="POST" class="my-8">
                @csrf
                <h2 class="text-2xl tracking-tight text-gray-900 font-silk">Beri Penilaian</h2>
                <p class="text-red-600 my-1 text-xs">{{ $errors->first('multipleReview') }}</p>
                <div class="star-rating flex mt-4">
                    @for($i=1; $i<=5; $i++)
                        <svg data-value="{{ $i }}" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="star w-8 h-8 mr-3 text-gray-500" viewBox="0 0 24 24">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" fill="currentColor"></path>
                        </svg>
                    @endfor        
                </div>
                <p class="text-sm text-red-600 mt-1">{{ $errors->first('rating') }}</p>   
                <div class="mt-4 relative">
                  <input type="text" name="review" value="{{ old('review') }}"" placeholder="Tulis sebuah ulasan.." class="{{ $errors->first('review') ? 'text-red-700' : 'text-gray-900' }} bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full py-8">
                  <p class="text-sm text-red-600">{{ $errors->first('review') }}</p>
                </div>

                @if(Auth::user())
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="rating" id="rating-value" value="0">
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <button class="mt-4 flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Kirim</button>
                    </form>
                @else
                    </form>
                    <a href="{{ route('login') }}">
                        <button class="mt-4 flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Kirim</button>
                    </a>
                @endif
              
            <div class="mt-4 flex justify-between items-center">
                <h2 class="text-2xl tracking-tight text-gray-900 mb-4 font-silk">Ulasan Ebook</h2>
                @if(count($reviews) > 0)
                <a href="{{ route('user.books.reviews.index', ['id' => $book->id]) }}">
                    <p class="text-xs text-gray-800 hover:text-red-500">Lihat semua</p>
                </a>
                @endif
            </div>
            @if(count($reviews) > 0)
            @foreach($reviews as $review)
            <article class="mb-16">
                <div class=" flex justify-between items-center">
                    <div class="flex mb-4">
                        <img class="mr-3 w-10 h-10 rounded-full" src="{{ $review->photo ? route("content.uprofile", ['id'=>$review->photo ]) : asset("images/icon/biografi.png") }}" alt="">
                        <div class="space-y-1 font-medium">
                            <p>{{ $review->name }} <span class="block text-xs text-gray-500">Bergabung {{ Carbon::parse($review->joined_at)->locale('id')->isoFormat('MMM YYYY') }}</span></p>
                        </div>
                    </div>
                    <div class="flex items-center mb-1">
                        @for($i=1; $i<=($review->star); $i++)
                            <svg aria-hidden="true" class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor

                        
                        @for($i=$review->star; $i<5; $i++)
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                </div>
                <div>
                    <p class="mb-2 font-light">{{ $review->review }}</p>
                    <p class="text-xs text-gray-500 mb-3">Diunggah {{ Carbon::parse($review->created_at)->locale('id')->isoFormat('DD MMMM YYYY hh:mm') }}</p>
                </div>
            </article>
            @endforeach
            @else
            <p class="mb-16">No reviews found</p>
            @endif
        </div>

        <!-- also purchased -->
        <div class="mx-auto pt-8 pb-16 border-top border-gray-200">
            <h2 class="text-2xl tracking-tight text-gray-900 mb-4 font-silk">Rekomendasi Untukmu</h2>
            <div class="mt-4 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                @foreach($related_books as $book)
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
                            <p class="mt-1 text-sm text-gray-500">{{ $penulis }}</p>
                        </div>
                        {{-- <p class="text-sm font-medium text-gray-900">$35</p> --}}
                    </div>
                </div>
                @endforeach
            
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#favorite-btn', function() {
            let $this = $(this);
            let bookId = $this.data('item');

            $.ajax({
                method: 'POST',
                url: '{{ route('user.books.favorites.toggle') }}',
                data: { _token: '{{ csrf_token() }}', book_id: bookId },
                success: function(response) {
                    if (response.status === 'removed') {
                        $this.removeClass('text-red-600').addClass('text-gray-500');
                    } else {
                        $this.removeClass('text-gray-500').addClass('text-red-600');
                    }
                }
            });
        });

        var bookId = '{{ $book->id }}';
        $.ajax({
            type: 'GET',
            url: '{{ route('user.books.favorites.isFavorite', ['id' => $book->id]) }}',
            success: function(data) {
                if(data.is_favorite) {
                    $('#favorite-btn').removeClass('text-gray-500').addClass('text-red-600');
                }
            }
        });

        $('.star').on('click', function() {
            let value = $(this).data('value');
            $('.star').each(function() {
                if($(this).data('value') <= value) {
                    $(this).removeClass('text-gray-500').addClass('text-red-600');
                } else {
                    $(this).removeClass('text-red-600').addClass('text-gray-500');
                }
            });
            $('#rating-value').val(value);
});
    })
</script>
@endsection