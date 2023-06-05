@extends('layouts.aapp')

@section('sub-content') 

<div class="p-4 bg-white block items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Edit Admin - #{{ $administrator->id }}</h1>
        </div>
    </div>
    <!-- Modal body -->
    <div class=" space-y-6">
        <form role="form" action="{{ route('admin.administrators.update', ['id'=>$administrator->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="{{ $errors->first('name') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Name<br><i>Maximum 150 characters</i></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $administrator->name) }}" class="{{ !$errors->first('name') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Ari Norma" required>
                    <p class="text-sm text-red-600">{{ $errors->first('name') }}</p>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="{{ $errors->first('email') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Email<br><i>Maximum 70 characters</i></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $administrator->email) }}" class="{{ !$errors->first('email') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="example@company.com" required>
                    <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="phone" class="{{ $errors->first('phone') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Phone Number<br><i>Maximum 13 characters</i></label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $administrator->phone) }}" class="{{ !$errors->first('phone') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }}shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. 081121411211" required>
                    <p class="text-sm text-red-600">{{ $errors->first('phone') }}</p>
                </div>
            </div> 

            <!-- Modal footer -->
            <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
            </div>
        </form>
    </div>

@endsection