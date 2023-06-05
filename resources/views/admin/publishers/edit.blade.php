@extends('layouts.aapp')

@section('sub-content') 

<div class="p-4 bg-white block items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Edit Publisher - #{{ $publisher->id }}</h1>
        </div>
    </div>
    <!-- Modal body -->
    <div class=" space-y-6">
        <form role="form" action="{{ route('admin.publishers.update', ['id'=>$publisher->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="{{ $errors->first('name') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Name<br><i>Maximum 150 characters</i></label>
                    <input value="{{ old('name', $publisher->name) }}" type="text" name="name" id="name" class="{{ !$errors->first('name') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Biografi" required>
                    <p class="text-sm text-red-600">{{ $errors->first('name') }}</p>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection