@extends('layouts.aapp')

@section('sub-content') 

<div class="p-4 bg-white block items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Edit Data Buku - #{{ $book->id }}</h1>
        </div>
    </div>
    <!-- Modal body -->
    <div class=" space-y-6">
        <form role="form" action="{{ route('admin.books.update', ['id'=>$book->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6 col-span-3">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="isbn" class="{{ $errors->first('isbn') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">ISBN</label>
                        <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" class="{{ !$errors->first('isbn') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. 9789792220186" required>
                        <p class="text-sm text-red-600">{{ $errors->first('isbn') }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tgl_terbit" class="text-sm font-medium text-gray-900 block mb-2">Tanggal Terbit</label>
                        <input value="{{ old('tgl_terbit', $book->tgl_terbit->toDateString()) }}" type="date" name="tgl_terbit" id="tgl_terbit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 col-span-3">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="judul" class="{{ $errors->first('judul') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $book->judul) }}" class="{{ !$errors->first('judul') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Rahasia Bintang" required>
                        <p class="text-sm text-red-600">{{ $errors->first('judul') }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="kategori" class="text-sm font-medium text-gray-900 block mb-2">Kategori Buku</label>
                        <select name="kategori" id="kategori" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('kategori') == $category->id || $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="penulis" class="{{ $errors->first('penulis') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Penulis</label>
                    <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $book->penulis) }}" class="{{ !$errors->first('penulis') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Dyan Nuranindya" required>
                    <p class="text-sm text-red-600">{{ $errors->first('penulis') }}</p>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="penerbit" class="{{ $errors->first('penerbit') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $book->penerbit) }}" class="{{ !$errors->first('penerbit') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Gramedia Pustaka Utama" required>
                    <p class="text-sm text-red-600">{{ $errors->first('penerbit') }}</p>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="sinopsis" class="{{ $errors->first('sinopsis') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Sinopsis</label>
                    <textarea style="white-space: pre-line" rows='12' type="text" name="sinopsis" id="sinopsis" class="{{ !$errors->first('sinopsis') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Sinopsis Buku" required>{{ old('sinopsis', $book->sinopsis) }}</textarea>
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
                                @if($book->img_cover == '' || is_null(($book->img_cover)))
                                    <img src="{{ asset('images/nocover.png') }}" alt="" class="w-full h-full" id="preview">
                                @else
                                    <img src="{{ route('content.cover', ['id'=>$book->img_cover]) }}" alt="book_photo"  class="w-full h-full" id="preview">
                                @endif
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
                    </div>
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