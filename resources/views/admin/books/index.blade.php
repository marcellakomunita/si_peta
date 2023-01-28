@extends('layouts.aapp')

@section('sub-content') 
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Data Ebook</h1>
        </div>

        <div class="sm-flex">
            <div class="sm:flex">
                <div class="hidden sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0">
                    <form action="{{ route('admin.books.index') }}" class="lg:pr-3" method="GET">
                        <label for="users-search" class="sr-only">Search</label>
                        <div class="mt-1 relative lg:w-64 xl:w-96">
                            <input type="text" name="key" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Search for books">
                        </div>
                    </form>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
                    <a href="{{ route('admin.books.create') }}">
                        <button type="button" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                            <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Add book
                        </button>
                    </a>
                    <a href="#" class="w-1/2 text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg>
                        Export
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <table class="table-fixed min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox"
                                        class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-cyan-200 h-4 w-4 rounded">
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Judul
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Penulis
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Penerbit
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Tahun Terbit
                            </th>
                            <th scope="col" class="p-4">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (count($books) > 0)
                            @foreach ($books as $book)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-4 w-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-id" aria-describedby="checkbox-1" type="checkbox"
                                                class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-cyan-200 h-4 w-4 rounded">
                                            <label for="checkbox-id" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap p-4 flex items-center space-x-6 mr-12">
                                        <img class="h-28 w-20 !important" src="{{ $book->img_cover ? route('content.cover', ['id'=>$book->id, 'ext'=>substr( strrchr($book->img_cover, '.'), 1)]) : asset('images/nocover.png')}}" loading="eager" alt="name avatar">
                                        <div class="text-sm font-normal text-gray-500">
                                            <div class="text-base font-semibold text-gray-900">{{ $book->judul }}</div>
                                            <div class="text-sm font-normal text-gray-500">{{ $book->isbn }}</div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-base font-medium text-gray-900">{{ $book->penulis }}</td>
                                    <td class="whitespace-nowrap p-4 text-base font-medium text-gray-900">{{ $book->penerbit }}</td>
                                    <td class="whitespace-nowrap p-4 text-base font-normal text-gray-900">
                                        {{ $book->tgl_terbit->format('Y'); }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap space-x-2">
                                        <a href="{{ route('admin.books.edit', $book->id) }}">
                                            <button type="button" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                                Edit book
                                            </button>
                                        </a>
                                        <button id="delete-user-btn" data-item='{{ $book->id }}' type="button" data-modal-toggle="delete-user-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                            <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            Delete book
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr class="h-12 text-center">
                                    <td colspan="5">No Books Found</td>
                                </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="bg-white sticky sm:flex items-center w-full sm:justify-between bottom-0 right-0 border-t border-gray-200 p-4">
    {{ $books->links('vendor.pagination') }}
</div>

<!-- Delete User Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="delete-user-modal">
    <div class="relative w-full max-w-lg px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="delete-user-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Are you sure you want to delete this book?</h3>
                <button id="confirm-destroy-btn" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                    <a href="#" id="confirm-destroy-link">
                        Yes, I'm sure
                    </a>
                </button>
                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center" data-modal-toggle="delete-user-modal">
                    No, cancel
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // delete
        var buttons = document.querySelectorAll("#delete-user-btn")
            for (i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function() {
                    document.querySelector('#confirm-destroy-btn').setAttribute('data-item', this.getAttribute('data-item'));
                });
        }

        $('#confirm-destroy-btn').click(function() {
            var itemid = $("#confirm-destroy-btn").attr('data-item');
            var url = "{{ route('admin.books.destroy') }}";
            url = url + "?id=" + itemid;
            $("#confirm-destroy-link").attr("href", url);
            $("#confirm-destroy-button").click();
        });
    });
</script>
@endsection