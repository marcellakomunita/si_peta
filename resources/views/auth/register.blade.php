@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="py-12" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('{{ asset('images/background.png') }}')">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-8 h-8 mr-2" src="{{ asset('images/sipeta.png') }}" alt="logo">
            <span class="text-white">Sipeta</span>    
        </a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-xl xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Register your account
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name"class="block mb-2 text-sm font-semibold {{ $errors->first('name') ? 'text-red-700' : 'text-gray-900' }}">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="bg-gray-50 border {{ !$errors->first('name') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="e.g. Ari Norma" required="">
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
                    </div>
                    <div class="">
                        <div class="flex justify-between">
                            <div class="flex-1 mr-2">
                                <label for="email" class="block mb-2 text-sm font-semibold {{ $errors->first('email') ? 'text-red-700' : 'text-gray-900' }}">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="bg-gray-50 border {{ !$errors->first('email') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="name@company.com" required="">
                            </div>
                            <div class="flex-1 ml-2">
                                <label for="phone" class="block mb-2 text-sm font-semibold {{ $errors->first('phone') ? 'text-red-700' : 'text-gray-900' }}">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="bg-gray-50 border {{ !$errors->first('phone') ? 'border-gray-300 text-gray-900' : 'border-red-500 text-red-900' }} border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="0811122112131" required="">
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('phone') }}</p>
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
                    <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign up</button>
                    <p class="text-sm font-light text-gray-500 text-center">
                        Already have an account? <a href="{{ route('login') }}" class= text-red-500 hover:underline font-semibold">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
