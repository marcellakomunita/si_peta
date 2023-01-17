@extends('layouts.aapp')

@section('sub-content') 

<div class="p-4 bg-white block items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Create e-Book</h1>
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
                        <label for="isbn" class="text-sm font-medium text-gray-900 block mb-2">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tgl_terbit" class="text-sm font-medium text-gray-900 block mb-2">Tanggal Terbit</label>
                        <input type="date" name="tgl_terbit" id="tgl_terbit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="judul" class="text-sm font-medium text-gray-900 block mb-2">Judul Buku</label>
                    <input type="text" name="judul" id="judul" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="penulis" class="text-sm font-medium text-gray-900 block mb-2">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="penerbit" class="text-sm font-medium text-gray-900 block mb-2">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                </div>
                {{-- <div class="grid grid-cols-2 gap-6 col-span-3"> --}}
                    {{-- <div class="col-span-6 sm:col-span-3">
                        <label for="tgl_terbit" class="text-sm font-medium text-gray-900 block mb-2">Tanggal Terbit</label>
                        <input type="date" name="tgl_terbit" id="tgl_terbit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                    </div> --}}
                    {{-- <div class="col-span-6 sm:col-span-3">
                        <label for="tipe_file" class="text-sm font-medium text-gray-900 block mb-2">File Extension</label>
                        <select name="tipe_file" id="tipe_file" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                            <option>--Choose file extension--</option>
                            <option>PDF</option>
                        </select>
                    </div>
                </div> --}}
                <div class="col-span-6 sm:col-span-3">
                    <label for="sinopsis" class="text-sm font-medium text-gray-900 block mb-2">Sinopsis</label>
                    <textarea style="white-space: pre-line" rows='12' type="text" name="sinopsis" id="sinopsis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required></textarea>
                </div>
                <div class="grid grid-cols-2 gap-6 col-span-3">
                    <div class="col-span-3 sm:col-span-1">
                        <label for="img_cover" class="flex align-center items-center h-16 custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 w-full p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M12 11v6"></path>
                                <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                             </svg>
                             File Cover
                        </label>
                        <input type="file" name="img_cover" id="img_cover" placeholder="Bonnie" required>
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label for="file_ebook" class="flex align-center items-center h-16 custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 w-full p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M12 11v6"></path>
                                <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                             </svg>
                             File e-Book
                        </label>
                        <input type="file" name="file_ebook" id="file_ebook" placeholder="Bonnie" required>
                    </div>
                </div>
            </div> 

            <!-- Modal footer -->
            <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
            </div>
        </form>

        @endif
    </div>

@endsection