@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex pb-20">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-3xl sm:shadow-lg sm:shadow-xl">

                <header class="text-xl font-bold bg-blue-50 text-gray-900 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-3xl">
                    {{ __('Login') }}
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-900 text-sm mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="text-base pl-4 py-2 form-input w-full rounded-full border-gray-300 focus:border-cyan-400 focus:ring-0 focus:ring-cyan-400 transition-colors @error('email') border-red-500 @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-900 text-sm mb-2 sm:mb-4">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="text-base pl-4 py-2 form-input w-full rounded-full border-gray-300 focus:border-cyan-400 focus:ring-0 focus:ring-cyan-400 transition-colors @error('password') border-red-500 @enderror"
                            name="password"
                            required>

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="inline-flex items-center text-sm text-gray-900" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox text-gray-900 rounded"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-cyan-400 hover:text-cyan-700 whitespace-no-wrap no-underline hover:underline ml-auto"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-2 rounded-full text-base leading-normal no-underline text-white bg-cyan-400 hover:bg-cyan-600 transition-colors duration-200 ease-in-out shadow-md hover:shadow-lg sm:py-3">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('register'))
                        <p class="w-full text-xs text-center text-gray-900 my-6 sm:text-sm sm:my-8">
                            {{ __("Don't have an account?") }}
                            <a class="text-cyan-400 hover:text-cyan-700 no-underline hover:underline" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </p>
                        @endif
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection
