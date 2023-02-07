@extends('layouts.aapp')

@section('sub-content') 
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200  ">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Manage Jumbotrons</h1>
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
                                Slides
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (count($jumbotrons) > 0)
                            @foreach ($jumbotrons as $key=>$jumbotron)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-4 w-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-id" aria-describedby="checkbox-1" type="checkbox"
                                                class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-cyan-200 h-4 w-4 rounded">
                                            <label for="checkbox-id" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td colspan="3" class="p-4 items-center whitespace-nowrap space-x-6 mr-12 lg:mr-0">
                                        <div class="flex justify-between text-sm font-normal text-gray-900 items-center">
                                            Slide {{ $key+1 }}
                                            <a href="{{ route('admin.jumbotrons.edit', $jumbotron->id) }}">
                                                <button type="button" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                                    Edit slide
                                                </button>
                                            </a>
                                        </div>
                                        <br>
                                        <img class="w-full m-0" src="{{ asset('images/jumbotrons') . '/' . $jumbotron->img_slide }}" alt="name avatar">
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr class="h-12 text-center">
                                    <td colspan="5">No Jumbotrons Found</td>
                                </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection