@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex pb-20">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-3xl sm:shadow-lg sm:shadow-xl">

                <header class="text-xl font-bold bg-blue-50 text-gray-900 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-3xl">
                    {{ __('Reset Password') }}
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-900 text-sm mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="text-base pl-4 py-2 form-input w-full rounded-full border-gray-300 focus:border-cyan-400 focus:ring-0 focus:ring-cyan-400 transition-colors @error('email') border-red-500 @enderror"
                            name="email"
                            value="{{ $email ?? old('email') }}"
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
                            required
                            autocomplete="new-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password-confirm" class="block text-gray-900 text-sm mb-2 sm:mb-4">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password"
                            class="text-base pl-4 py-2 form-input w-full rounded-full border-gray-300 focus:border-cyan-400 focus:ring-0 focus:ring-cyan-400 transition-colors"
                            name="password_confirmation"
                            required
                            autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-2 mb-12 rounded-full text-base leading-normal no-underline text-white bg-cyan-400 hover:bg-cyan-600 transition-colors duration-200 ease-in-out shadow-md hover:shadow-lg sm:py-3">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection
