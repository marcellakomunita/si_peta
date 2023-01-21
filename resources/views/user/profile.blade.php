@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40" style="background-color: #f8f8f8">
    <div class="w-full">
        <div class="mb-8 bg-white rounded-md shadow-sm p-4">  
                <div class="space-y-6">
                    <form role="form" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="flex justify-between">

                            <span class="w-2/3">
                                <!-- Modal body -->
                                <div class="grid grid-cols-2 gap-6">
                                    @csrf
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Nama</label>
                                        <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                                        <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="example@company.com" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                                        <input type="number" name="phone" id="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. +(12)3456 789" required>
                                    </div>
                                </div> 

                                <!-- Modal footer -->
                                <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                                    <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
                                </div>
                            </span>

                            <!-- Profile Photo -->
                            <span>
                                <div class="rounded-md border-gray-500 shadow-sm w-48 h-64">
                                    <img src="https://upload.wikimedia.org/wikipedia/id/1/18/Spring_in_London_%28sampul%29.jpg" alt="" class="w-full h-full">
                                </div>
                                <label for="user_photo" class="flex align-center items-center justify-center w-fit mx-auto mt-3 py-2 custom-file shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 icon icon-tabler icon-tabler-file-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        <path d="M12 11v6"></path>
                                        <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                                     </svg>
                                     Change Photo
                                </label>
                                <input type="file" name="user_photo" id="user_photo" placeholder="Bonnie" required>
                            </span>
                    </form>
                </div>

                
                
        </div>
    </div>
</div>

@endsection