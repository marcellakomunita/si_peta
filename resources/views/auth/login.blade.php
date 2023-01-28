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
                    Sign in to your account
                    <p class="mt-2 font-medium text-sm text-red-600">{{ $errors->first('failed') }}</p>
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-semibold {{ $errors->first('email') ? 'text-red-700' : 'text-gray-900' }}">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="bg-gray-50 border {{ !$errors->first('email') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="name@company.com" required="">
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-semibold {{ $errors->first('password') ? 'text-red-700' : 'text-gray-900' }}">Password</label>
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="bg-gray-50 border {{ !$errors->first('password') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required="">
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                              <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300">
                            </div>
                            <div class="ml-3 text-sm">
                              <label for="remember" class="text-gray-500" {{ old('remember') ? 'checked' : '' }}>Remember me</label>
                            </div>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-red-500 hover:underline font-semibold">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                    <p class="text-sm font-light text-gray-500 text-center">
                        Don’t have an account yet? <a href="{{ route('register') }}" class= text-red-500 hover:underline font-semibold">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
