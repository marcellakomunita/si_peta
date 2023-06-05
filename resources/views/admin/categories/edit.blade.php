@extends('layouts.aapp')

@section('sub-content') 

<div class="p-4 bg-white block items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Edit Category - #{{ $category->id }}</h1>
        </div>
    </div>
    <!-- Modal body -->
    <div class=" space-y-6">
        <form role="form" action="{{ route('admin.categories.update', ['id'=>$category->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="{{ $errors->first('name') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Name<br><i>Maximum 100 characters</i></label>
                    <input value="{{ old('name', $category->name) }}" type="text" name="name" id="name" class="{{ !$errors->first('name') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Biografi" required>
                    <p class="text-sm text-red-600">{{ $errors->first('name') }}</p>
                </div>
                <div class="col-span-6 sm:col-span-3 w-1/2">
                    <label for="img_icon" id="cover-label" class="h-16 flex items-center custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 w-full p-2.5">
                        <div class="flex align-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M12 11v6"></path>
                                <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                            </svg>
                             <p>
                                File Icon<br><i>Support JPG, PNG, or JPEG file with maximum size 2MB</i>
                            </p>
                        </div>
                         
                        <div class="rounded-md border-gray-500 shadow-sm w-48 h-64 mx-auto my-4 collapse" id="preview-container">
                            @if($category->img_icon == '' || is_null(($category->img_icon)))
                                <img src="{{ asset('images/nocover.png') }}" alt="" class="w-full h-full" id="preview">
                            @else
                                <img src="{{ asset('images/icon') . '/' . strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.' . substr( strrchr($category->img_icon, '.'), 1) }}" alt="book_photo"  class="w-full h-full" id="preview">
                            @endif
                        </div>
                    </label>
                    <input type="file" style="display: none;" name="img_icon" id="img_icon" placeholder="Bonnie">
                    <p class="text-sm text-red-600">{{ $errors->first('img_icon') }}</p>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
            </div>
        </form>
    </div>

<script>
    $(document).ready(function() {
        document.querySelector('#img_icon').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                // Do something with the dataURI
                var dataURI = reader.result;
                // display the image preview
                document.querySelector('#cover-label').classList.remove('h-16', 'flex', 'items-center');
                document.querySelector('#preview-container').classList.remove('collapse');
                document.querySelector('#preview').src = dataURI;
            };

            reader.readAsDataURL(file);
        });
    })
</script>
@endsection