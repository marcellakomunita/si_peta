@extends('layouts.uapp')
 
@section('sub-content')
<div class="flex" >  
    <x-user.asidecategories :categories="$categories"/>

    <div id="products" class="pt-[12.5rem] md:pt-[11.5rem] pb-16 w-full md:px-4">
        
        <div class="flex flex-col md:flex-row justify-between">
            {{ $books->appends(request()->input())->links('vendor.pagination') }}
            <form action="{{ route('user.books.search', ['q' => request()->query('q'), 'based_on' => request()->query('based_on')]) }}" method="get">
                <select name="based_on" onchange="this.form.submit()" id="based_on" class="bg-gray-50 w-full md:w-48 my-3 md:my-0 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    <option value="latest" {{ request()->query('based_on') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="most-favorite" {{ request()->query('based_on') == 'most-favorite' ? 'selected' : '' }}>Terpopuler</option>
                </select>
                @if(request()->query('q'))
                    <input type="hidden" name="q" value="{{ request()->query('q') }}">
                @elseif(request()->query('category'))
                    <input type="hidden" name="category" value="{{ request()->query('category') }}">
                @endif
            </form>
        </div>

        @include('user.books.partial-list')


    </div>
</div>
@endsection