@extends('layouts.aapp')

@section('sub-content') 

<div class="p-4 bg-white block items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Create Ebook</h1>
        </div>
    </div>
    <!-- Modal body -->
    <div class=" space-y-6">
        @if ($errors->has('error'))
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>

        @else
        <form role="form" action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 gap-6">
                @csrf
                <div class="grid grid-cols-2 gap-6 col-span-3">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="isbn" class="{{ $errors->first('isbn') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">ISBN</label>
                        <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" class="{{ !$errors->first('isbn') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. 9789792220186" required>
                        <p class="text-sm text-red-600">{{ $errors->first('isbn') }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tgl_terbit" class="text-sm font-medium text-gray-900 block mb-2">Tanggal Terbit</label>
                        <input value="{{ old('tgl_terbit') }}" type="date" name="tgl_terbit" id="tgl_terbit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 col-span-3">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="judul" class="{{ $errors->first('judul') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="{{ !$errors->first('judul') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Rahasia Bintang" required>
                        <p class="text-sm text-red-600">{{ $errors->first('judul') }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="kategori" class="text-sm font-medium text-gray-900 block mb-2">Kategori Buku</label>
                        <select name="kategori" id="kategori" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="penulis" class="text-sm font-medium text-gray-900 block mb-2">Penulis Buku</label>
                    <select name="penulis" id="penulis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('penulis') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="penerbit" class="{{ $errors->first('penerbit') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Penerbit</label>
                    <select name="penerbit" id="penerbit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ old('penerbit') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="sinopsis" class="{{ $errors->first('sinopsis') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Sinopsis</label>
                    <textarea style="white-space: pre-line" rows='12' type="text" name="sinopsis" id="sinopsis" class="{{ !$errors->first('sinopsis') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Sinopsis Buku" required>{{ old('sinopsis') }}</textarea>
                    <p class="text-sm text-red-600">{{ $errors->first('sinopsis') }}</p>
                </div>
                <div class="grid grid-cols-2 gap-6 col-span-3">
                    <div class="col-span-3 sm:col-span-1">
                        <label for="img_cover" id="cover-label" class="h-16 flex items-center custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 w-full p-2.5">
                            <div class="flex align-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                    <path d="M12 11v6"></path>
                                    <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                                </svg>
                                File Cover
                            </div>
                             
                            <div class="rounded-md border-gray-500 shadow-sm w-48 h-64 mx-auto my-4 collapse" id="preview-container">
                                <img src="#" alt="" class="w-full h-full" id="preview">
                            </div>
                        </label>
                        <input type="file" style="display: none;" name="img_cover" id="img_cover" placeholder="Bonnie">
                        <p class="text-sm text-red-600">{{ $errors->first('img_cover') }}</p>
                    </div>
                    <div class="col-span-3 sm:col-span-1 dropzone border-none p-0" id="myDropzone">
                        <div class="fallback">
                            <label for="file_ebook" class="flex align-center items-center h-16 custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 w-full p-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                    <path d="M12 11v6"></path>
                                    <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                                 </svg>
                                 File Ebook
                            </label>
                            <input type="file" style="display: none;" name="file_ebook[]" id="file_ebook" placeholder="Bonnie" multiple>
                            <p class="text-sm text-red-600">{{ $errors->first('file_ebook') }}</p>
                        </div>
                        {{-- <label for="file_ebook" class="flex align-center items-center h-16 custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 w-full p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M12 11v6"></path>
                                <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                             </svg>
                             File Ebook
                        </label>
                        <input type="file" style="display: none;" name="file_ebook" id="file_ebook" placeholder="Bonnie">
                        <p class="text-sm text-red-600">{{ $errors->first('file_ebook') }}</p> --}}

                    </div>
                </div>
            </div> 

            <!-- Modal footer -->
            <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
            </div>
        </form>

        <!-- Include the Dropzone CSS and JavaScript files -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeLZgmHs5A==" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-cNcj5i5o5vbUhQ9n9lKL2EiOX+rJFhKj3kL0bFQ3Lrq3H3CitF9oUsoVmshRNLxvyzQZgHGZ+dpbbMvDPL8Mhw==" crossorigin="anonymous"></script>

        <!-- Initialize Dropzone -->
        <script>
            Dropzone.options.myDropzone = {
                url: "{{ route('admin.books.store') }}",
                maxFilesize: 2, // MB
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true
            };
        </script>

        @endif
    </div>

<script>
    $(document).ready(function() {
        document.querySelector('#img_cover').addEventListener('change', function(event) {
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