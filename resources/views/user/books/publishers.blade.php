@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40">
    <div class="w-full">
        <div id="navigation" class="py-4 px-2 border-y border-gray-500 flex justify-between">
            @foreach (range('A','Z') as $index)
                <a href="{{ '#index-' . $index }}" class="hover:cursor-pointer">{{ $index }}</a>
            @endforeach
        </div>
        <div class="content">
            @if(count($publishers) > 0)
            @foreach ($publishers as $letter => $publisher)
                <div id="{{ 'index-' . $letter }}" class="flex items-center py-8 border-b border-gray-500">
                    <div class="bg-red-500 text-white p-4 mr-8 rounded-full w-12 h-12 flex items-center justify-center font-silk text-xl">
                        {{ $letter }}
                    </div>
                    
                    <div class="grid grid-cols-3 w-full">
                        @foreach ($publisher as $item)
                        <a href="{{ route('user.books.publisher', ['id' => $item['id']]) }}">{{ $item['name'] }}</a>
                        @endforeach

                    </div>
                </div>
            @endforeach
            @else
            <div class="my-4 bg-white rounded-md shadow-sm">
                <div class="py-24 flex flex-col items-center justify-center">
                    No publishers found
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection