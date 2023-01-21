@extends('layouts.uapp')
 
@section('sub-content')
<div class="flex" style="background-color: #f8f8f8">  
    <x-user.aside-categories/>

    <div id="products" class="pt-[9.5rem] pb-16 w-full px-4">
        
        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block pb-2 px-12 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ebook</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block pb-2 px-12 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Penulis</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div class="hidden rounded-lg bg-gray-50" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="pt-3 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                    @for($i = 0; $i < 12; $i++)
                        <div class="group relative rounded-t-xl">
                            <div class="">
                                <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-60">
                                    <img src="https://upload.wikimedia.org/wikipedia/id/1/18/Spring_in_London_%28sampul%29.jpg" alt="Front of men&#039;s Basic Tee in black." class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                            </div>
                            <div class="rounded-b-lg px-4 py-3 flex justify-between bg-white">
                                <div>
                                    <h3 class="font-bold text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Springs in London
                                    </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">Ilana Tan</p>
                                </div>
                                {{-- <p class="text-sm font-medium text-gray-900">$35</p> --}}
                            </div>
                        </div>
                    @endfor
    
                    <div class="bg-white sticky sm:flex items-center w-full sm:justify-between bottom-0 right-0 border-t border-gray-200 p-4">
                        {{-- {{ $books->links('vendor.pagination') }} --}}
                    </div>
                </div>
            </div>
    
            <div class="hidden rounded-lg bg-gray-50" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="pt-3 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                    @for($i = 0; $i < 12; $i++)
                        <div class="group relative rounded-t-xl">
                            <div class="">
                                <div class="bg-white min-h-60 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-60">
                                    <img src="https://upload.wikimedia.org/wikipedia/id/1/18/Spring_in_London_%28sampul%29.jpg" alt="Front of men&#039;s Basic Tee in black." class="rounded-t-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                            </div>
                            <div class="rounded-b-lg px-4 py-3 flex justify-between bg-white">
                                <div>
                                    <h3 class="font-bold text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Spring in London
                                    </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">Ilana Tan</p>
                                </div>
                                {{-- <p class="text-sm font-medium text-gray-900">$35</p> --}}
                            </div>
                        </div>
                    @endfor
    
                    <div class="bg-white sticky sm:flex items-center w-full sm:justify-between bottom-0 right-0 border-t border-gray-200 p-4">
                        {{-- {{ $books->links('vendor.pagination') }} --}}
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
  @endsection