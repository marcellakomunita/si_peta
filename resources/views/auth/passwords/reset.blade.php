@extends('layouts.app')

@section('content')
<div class="" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('{{ asset('images/background.png') }}')">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-8 h-8 mr-2" src="{{ asset('images/sipeta.png') }}" alt="logo">
            <span class="text-white">Sipeta</span>    
        </a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Reset Password
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('password.update') }}" method="POST">
                    @csrf
                
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-semibold {{ $errors->first('email') ? 'text-red-700' : 'text-gray-900' }}">Email</label>
                        <input type="email" name="email" id="email" required placeholder="••••••••" class="bg-gray-50 border {{ !$errors->first('email') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required="">
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-semibold {{ $errors->first('password') ? 'text-red-700' : 'text-gray-900' }}">Password</label>
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="bg-gray-50 border {{ !$errors->first('password') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required="">
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-semibold {{ $errors->first('password_confirmation') ? 'text-red-700' : 'text-gray-900' }}">Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••" class="bg-gray-50 border {{ !$errors->first('password_confirmation') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required="">
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password_confirmation') }}</p>
                    </div>
                
                    <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
