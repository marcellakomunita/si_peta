@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40" style="background-color: #f8f8f8">
    <div class="w-full">
        <div class="mb-8 bg-white rounded-md shadow-sm p-4">  
                <div class="space-y-6">
                    <form role="form" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="flex justify-between">

                            <span class="w-2/3">
                                <!-- Modal body -->
                                <div class="grid grid-cols-2 gap-6">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="{{ $errors->first('name') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Nama</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="{{ !$errors->first('name') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. Ari Norma" required>
                                        <p class="text-sm text-red-600">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="{{ $errors->first('email') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="{{ !$errors->first('email') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="example@company.com" required>
                                        <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone" class="{{ $errors->first('phone') ? 'text-red-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="{{ !$errors->first('phone') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }}shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. 081121411211" required>
                                        <p class="text-sm text-red-600">{{ $errors->first('phone') }}</p>
                                    </div>
                                </div> 

                                <!-- Modal footer -->
                                <div class="items-center py-6 border-t mt-4 border-gray-200 rounded-b">
                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
                                </div>
                            </span>

                            <!-- Profile Photo -->
                            <span>
                                <div class="rounded-md border-gray-500 shadow-sm w-48 h-64">
                                    @if($user->photo == '' || is_null(($user->photo)))
                                        <img src="{{ asset('images/icon/biografi.png') }}" alt="" class="w-full h-full" id="preview">
                                    @else
                                        <img src="{{ route('content.uprofile', ['id'=>$user->id, 'ext'=>substr( strrchr($user->photo, '.'), 1)]) }}" alt="user_photo"  class="w-full h-full" id="preview">
                                    @endif
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
                                <input type="file" name="user_photo" id="user_photo" placeholder="Bonnie">
                                <p class="text-sm text-red-600">{{ $errors->first('user_photo') }}</p>
                            </span>
                    </form>
                </div>

                
                
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        document.querySelector('#user_photo').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                // Do something with the dataURI
                var dataURI = reader.result;
                // display the image preview
                document.querySelector('#preview').src = dataURI;
            };

            reader.readAsDataURL(file);
        });
    })
</script>
@endsection