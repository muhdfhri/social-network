{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('title', 'Register')
@section('content')
    <div class="flex min-h-screen py-8">
        <div class="container px-6 mx-auto flex justify-center items-start">
            <div class="p-6 bg-gray-300 rounded-lg shadow-xl w-full max-w-2xl my-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Buat Akun Baru</h2>
                @foreach ($errors->all() as $error)
                    <div role="alert"
                        class="w-full mb-2 p-2 bg-red-800 rounded-full items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex">
                        <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">ERROR</span>
                        <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                    </div>
                @endforeach

                <form class="flex flex-col" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf

                    <label class="block mt-2 text-sm">
                        <span class="text-gray-700 font-medium mb-1 block">Foto Profil</span>
                        <div class="relative text-gray-500">
                            <div class="block w-full mt-1 text-sm text-black border border-gray-400 rounded-md p-2 bg-white">
                                <input type="file" name="profile" id="profile" accept="image/*">
                            </div>
                            <p class="text-xs text-red-600 mt-1 hidden" id="profile-error"></p>
                        </div>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 font-medium mb-1 block">NIM <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="text" name="nim" id="nim"
                                class="block w-full pl-10 pr-3 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="NIM (contoh: 123456789)" 
                                />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 hidden" id="nim-valid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-600 hidden" id="nim-invalid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">Masukkan NIM 9 digit dan pastikan Anda merupakan mahasiswa fakultas ilmu komputer UNUSU agar valid dan bisa mendaftar</p>
                        <p class="text-xs text-red-600 mt-1 hidden" id="nim-error"></p>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 font-medium mb-1 block">Nama Depan <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="text" name="first_name" id="first_name"
                                class="block w-full pl-10 pr-10 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Nama Depan" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 hidden" id="first_name-valid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-red-600 mt-1 hidden" id="first_name-error"></p>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 font-medium mb-1 block">Nama Belakang <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="text" name="last_name" id="last_name"
                                class="block w-full pl-10 pr-10 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Nama Belakang" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 hidden" id="last_name-valid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-red-600 mt-1 hidden" id="last_name-error"></p>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 font-medium mb-1 block">Username <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="text" name="username" id="username"
                                class="block w-full pl-10 pr-10 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Username" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 hidden" id="username-valid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-red-600 mt-1 hidden" id="username-error"></p>
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 font-medium mb-1 block">Email <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="email" name="email" id="email"
                                class="block w-full pl-10 pr-10 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Masukkan Gmail" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 hidden" id="email-valid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-600 hidden" id="email-invalid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-red-600 mt-1 hidden" id="email-error"></p>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium mb-1 block">Kata Sandi <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="password" name="password" id="password"
                                class="block w-full pl-10 pr-16 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Masukkan Kata Sandi" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <button type="button"
                                class="password-toggle-icon absolute inset-y-0 right-0 flex items-center px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md hover:bg-purple-700"
                                onclick="password_show_hide()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="hidden w-5 h-5" id="show">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5" id="hide">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2 space-y-1">
                            <p class="text-xs text-gray-600" id="password-length">
                                <span class="inline-block w-4 h-4 mr-1">○</span>Minimal 8 karakter
                            </p>
                            <p class="text-xs text-gray-600" id="password-uppercase">
                                <span class="inline-block w-4 h-4 mr-1">○</span>Minimal 1 huruf besar
                            </p>
                            <p class="text-xs text-gray-600" id="password-lowercase">
                                <span class="inline-block w-4 h-4 mr-1">○</span>Minimal 1 huruf kecil
                            </p>
                            <p class="text-xs text-gray-600" id="password-number">
                                <span class="inline-block w-4 h-4 mr-1">○</span>Minimal 1 angka
                            </p>
                        </div>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium mb-1 block">Konfirmasi Kata Sandi <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500 focus-within:text-purple-600">
                            <input required type="password" name="password_confirmation" id="cpassword"
                                class="block w-full pl-10 pr-16 py-2 text-sm text-black border border-gray-400 rounded-md focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                placeholder="Konfirmasi Kata Sandi" />
                            <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <button type="button"
                                class="password-toggle-icon absolute inset-y-0 right-0 flex items-center px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md hover:bg-purple-700"
                                onclick="cpassword_show_hide()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="hidden w-5 h-5" id="cshow">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5" id="chide">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                            <div class="absolute inset-y-0 right-14 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 hidden" id="cpassword-valid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-600 hidden" id="cpassword-invalid">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-red-600 mt-1 hidden" id="cpassword-error"></p>
                    </label>

                    <div class="block mt-4 text-sm">
                        <span class="text-gray-700 font-medium mb-2 block">Jenis Kelamin <span class="text-red-600">*</span></span>
                        <div class="relative text-gray-500">
                            <div class="block w-full text-sm text-black border border-gray-400 rounded-md p-3 bg-white">
                                <div class="flex justify-evenly">
                                    <div class="flex items-center">
                                        <input required type="radio" name="gender" id="male" value="male"
                                            class="form-radio text-purple-600">
                                        <label for="male" class="pl-2 cursor-pointer">Laki-laki</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input required type="radio" name="gender" id="female" value="female"
                                            class="form-radio text-purple-600">
                                        <label for="female" class="pl-2 cursor-pointer">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-red-600 mt-1 hidden" id="gender-error"></p>
                    </div>

                    <div class="flex mt-4 text-sm">
                        <label class="flex items-start cursor-pointer">
                            <input type="checkbox" name="terms" id="terms"
                                class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple mt-1" />
                            <span class="ml-2">
                                Saya setuju dengan
                                <a href="{{ route('terms-and-conditions') }}" class="text-blue-600 font-semibold hover:underline">syarat dan ketentuan</a>. <span class="text-red-600">*</span>
                            </span>
                        </label>
                    </div>
                    <p class="text-xs text-red-600 mt-1 hidden" id="terms-error"></p>

                    <button
                        class="text-white font-bold py-2 px-4 mt-6 mx-auto rounded-md border-2 bg-black hover:bg-gray-800 transition-colors w-full disabled:bg-gray-400 disabled:cursor-not-allowed"
                        type="submit" id="submitBtn">Daftar</button>
                    
                    <span class="text-black text-sm text-center mt-4">Sudah punya akun? <a
                            href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk</a></span>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validasi NIM
        document.getElementById('nim').addEventListener('input', function(e) {
        const nim = e.target.value.trim();
        const nimError = document.getElementById('nim-error');
        const nimValid = document.getElementById('nim-valid');
        const nimInvalid = document.getElementById('nim-invalid');

        // Reset state awal
        if (nim.length === 0) {
            nimError.classList.add('hidden');
            nimValid.classList.add('hidden');
            nimInvalid.classList.add('hidden');
            e.target.classList.remove('border-red-500', 'border-green-500');
            return;
        }

        // Validasi hanya angka
        if (!/^\d*$/.test(nim)) {
            nimError.textContent = 'NIM hanya boleh berisi angka';
            nimError.classList.remove('hidden');
            nimValid.classList.add('hidden');
            nimInvalid.classList.remove('hidden');
            e.target.classList.add('border-red-500');
            e.target.classList.remove('border-green-500');
            return;
        }

        // Batasi maksimal 9 digit
        if (nim.length > 9) {
            e.target.value = nim.slice(0, 9);
            return;
        }

        // Validasi pola wajib: 7 digit pertama harus 1211050 dan total 9 digit
        const nimPattern = /^1211050\d{2}$/;
        if (nimPattern.test(nim)) {
            // ✅ Valid
            nimError.classList.add('hidden');
            nimValid.classList.remove('hidden');
            nimInvalid.classList.add('hidden');
            e.target.classList.remove('border-red-500');
            e.target.classList.add('border-green-500');
        } else {
            // ❌ Tidak valid
            nimError.textContent = 'NIM tidak sesuai dengan format khusus mahasiswa Fakultas Ilmu Komputer (UNUSU).';
            nimError.classList.remove('hidden');
            nimValid.classList.add('hidden');
            nimInvalid.classList.remove('hidden');
            e.target.classList.add('border-red-500');
            e.target.classList.remove('border-green-500');
        }
    });

        // Validasi Nama Depan
        document.getElementById('first_name').addEventListener('input', function(e) {
            const firstName = e.target.value.trim();
            const error = document.getElementById('first_name-error');
            const valid = document.getElementById('first_name-valid');
            
            if (firstName.length === 0) {
                error.classList.add('hidden');
                valid.classList.add('hidden');
                e.target.classList.remove('border-red-500', 'border-green-500');
            } else if (firstName.length < 2) {
                error.textContent = 'Nama depan minimal 2 karakter';
                error.classList.remove('hidden');
                valid.classList.add('hidden');
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else {
                error.classList.add('hidden');
                valid.classList.remove('hidden');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            }
        });

        // Validasi Nama Belakang
        document.getElementById('last_name').addEventListener('input', function(e) {
            const lastName = e.target.value.trim();
            const error = document.getElementById('last_name-error');
            const valid = document.getElementById('last_name-valid');
            
            if (lastName.length === 0) {
                error.classList.add('hidden');
                valid.classList.add('hidden');
                e.target.classList.remove('border-red-500', 'border-green-500');
            } else if (lastName.length < 2) {
                error.textContent = 'Nama belakang minimal 2 karakter';
                error.classList.remove('hidden');
                valid.classList.add('hidden');
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else {
                error.classList.add('hidden');
                valid.classList.remove('hidden');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            }
        });

        // Validasi Username
        document.getElementById('username').addEventListener('input', function(e) {
            const username = e.target.value.trim();
            const error = document.getElementById('username-error');
            const valid = document.getElementById('username-valid');
            
            if (username.length === 0) {
                error.classList.add('hidden');
                valid.classList.add('hidden');
                e.target.classList.remove('border-red-500', 'border-green-500');
            } else if (username.length < 3) {
                error.textContent = 'Username minimal 3 karakter';
                error.classList.remove('hidden');
                valid.classList.add('hidden');
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                error.textContent = 'Username hanya boleh berisi huruf, angka, dan underscore';
                error.classList.remove('hidden');
                valid.classList.add('hidden');
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else {
                error.classList.add('hidden');
                valid.classList.remove('hidden');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            }
        });

        // Validasi Email
        document.getElementById('email').addEventListener('input', function(e) {
            const email = e.target.value.trim();
            const error = document.getElementById('email-error');
            const valid = document.getElementById('email-valid');
            const invalid = document.getElementById('email-invalid');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email.length === 0) {
                error.classList.add('hidden');
                valid.classList.add('hidden');
                invalid.classList.add('hidden');
                e.target.classList.remove('border-red-500', 'border-green-500');
            } else if (!emailRegex.test(email)) {
                error.textContent = 'Format email tidak valid';
                error.classList.remove('hidden');
                valid.classList.add('hidden');
                invalid.classList.remove('hidden');
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else {
                error.classList.add('hidden');
                valid.classList.remove('hidden');
                invalid.classList.add('hidden');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            }
        });

        // Validasi Password dengan indikator kekuatan
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const lengthCheck = document.getElementById('password-length');
            const uppercaseCheck = document.getElementById('password-uppercase');
            const lowercaseCheck = document.getElementById('password-lowercase');
            const numberCheck = document.getElementById('password-number');
            
            // Check length
            if (password.length >= 8) {
                lengthCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1 text-green-600">✓</span><span class="text-green-600">Minimal 8 karakter</span>';
            } else {
                lengthCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1">○</span>Minimal 8 karakter';
            }
            
            // Check uppercase
            if (/[A-Z]/.test(password)) {
                uppercaseCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1 text-green-600">✓</span><span class="text-green-600">Minimal 1 huruf besar</span>';
            } else {
                uppercaseCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1">○</span>Minimal 1 huruf besar';
            }
            
            // Check lowercase
            if (/[a-z]/.test(password)) {
                lowercaseCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1 text-green-600">✓</span><span class="text-green-600">Minimal 1 huruf kecil</span>';
            } else {
                lowercaseCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1">○</span>Minimal 1 huruf kecil';
            }
            
            // Check number
            if (/[0-9]/.test(password)) {
                numberCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1 text-green-600">✓</span><span class="text-green-600">Minimal 1 angka</span>';
            } else {
                numberCheck.innerHTML = '<span class="inline-block w-4 h-4 mr-1">○</span>Minimal 1 angka';
            }
            
            // Check all requirements
            const allValid = password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password);
            
            if (password.length > 0 && allValid) {
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            } else if (password.length > 0) {
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else {
                e.target.classList.remove('border-red-500', 'border-green-500');
            }
            
            // Re-validate confirm password
            if (document.getElementById('cpassword').value) {
                document.getElementById('cpassword').dispatchEvent(new Event('input'));
            }
        });

        // Validasi Konfirmasi Password
        document.getElementById('cpassword').addEventListener('input', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = e.target.value;
            const error = document.getElementById('cpassword-error');
            const valid = document.getElementById('cpassword-valid');
            const invalid = document.getElementById('cpassword-invalid');
            
            if (confirmPassword.length === 0) {
                error.classList.add('hidden');
                valid.classList.add('hidden');
                invalid.classList.add('hidden');
                e.target.classList.remove('border-red-500', 'border-green-500');
            } else if (password !== confirmPassword) {
                error.textContent = 'Kata sandi tidak cocok';
                error.classList.remove('hidden');
                valid.classList.add('hidden');
                invalid.classList.remove('hidden');
                e.target.classList.add('border-red-500');
                e.target.classList.remove('border-green-500');
            } else {
                error.classList.add('hidden');
                valid.classList.remove('hidden');
                invalid.classList.add('hidden');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            }
        });

        // Validasi Gender
        document.querySelectorAll('input[name="gender"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('gender-error').classList.add('hidden');
            });
        });

        // Validasi Terms
        document.getElementById('terms').addEventListener('change', function(e) {
            const error = document.getElementById('terms-error');
            if (!e.target.checked) {
                error.textContent = 'Anda harus menyetujui syarat dan ketentuan';
                error.classList.remove('hidden');
            } else {
                error.classList.add('hidden');
            }
        });

        // Validasi File Upload
        document.getElementById('profile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const error = document.getElementById('profile-error');
            
            if (file) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                
                if (!allowedTypes.includes(file.type)) {
                    error.textContent = 'Format file harus JPG, JPEG, PNG, atau GIF';
                    error.classList.remove('hidden');
                    e.target.value = '';
                } else if (file.size > maxSize) {
                    error.textContent = 'Ukuran file maksimal 2MB';
                    error.classList.remove('hidden');
                    e.target.value = '';
                } else {
                    error.classList.add('hidden');
                }
            }
        });

        // Validasi Form sebelum submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            let firstError = null;

            // Validasi NIM
            const nim = document.getElementById('nim').value;
            if (!nim || nim.length !== 9 || !nim.startsWith('1') || !/^\d+$/.test(nim)) {
                document.getElementById('nim-error').textContent = 'NIM harus 9 digit dan sesuai dengan format khusus mahasiswa fakultas ilmu komputer';
                document.getElementById('nim-error').classList.remove('hidden');
                document.getElementById('nim').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('nim');
            }

            // Validasi Nama Depan
            const firstName = document.getElementById('first_name').value.trim();
            if (!firstName || firstName.length < 2) {
                document.getElementById('first_name-error').textContent = 'Nama depan minimal 2 karakter';
                document.getElementById('first_name-error').classList.remove('hidden');
                document.getElementById('first_name').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('first_name');
            }

            // Validasi Nama Belakang
            const lastName = document.getElementById('last_name').value.trim();
            if (!lastName || lastName.length < 2) {
                document.getElementById('last_name-error').textContent = 'Nama belakang minimal 2 karakter';
                document.getElementById('last_name-error').classList.remove('hidden');
                document.getElementById('last_name').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('last_name');
            }

            // Validasi Username
            const username = document.getElementById('username').value.trim();
            if (!username || username.length < 3 || !/^[a-zA-Z0-9_]+$/.test(username)) {
                document.getElementById('username-error').textContent = 'Username minimal 3 karakter (huruf, angka, underscore)';
                document.getElementById('username-error').classList.remove('hidden');
                document.getElementById('username').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('username');
            }

            // Validasi Email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email)) {
                document.getElementById('email-error').textContent = 'Format email tidak valid';
                document.getElementById('email-error').classList.remove('hidden');
                document.getElementById('email').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('email');
            }

            // Validasi Password
            const password = document.getElementById('password').value;
            if (!password || password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password)) {
                alert('Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, dan angka');
                document.getElementById('password').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('password');
            }

            // Validasi Konfirmasi Password
            const confirmPassword = document.getElementById('cpassword').value;
            if (password !== confirmPassword) {
                document.getElementById('cpassword-error').textContent = 'Kata sandi tidak cocok';
                document.getElementById('cpassword-error').classList.remove('hidden');
                document.getElementById('cpassword').classList.add('border-red-500');
                isValid = false;
                if (!firstError) firstError = document.getElementById('cpassword');
            }

            // Validasi Gender
            const gender = document.querySelector('input[name="gender"]:checked');
            if (!gender) {
                document.getElementById('gender-error').textContent = 'Pilih jenis kelamin';
                document.getElementById('gender-error').classList.remove('hidden');
                isValid = false;
            }

            // Validasi Terms
            const terms = document.getElementById('terms').checked;
            if (!terms) {
                document.getElementById('terms-error').textContent = 'Anda harus menyetujui syarat dan ketentuan';
                document.getElementById('terms-error').classList.remove('hidden');
                isValid = false;
                if (!firstError) firstError = document.getElementById('terms');
            }

            if (!isValid) {
                e.preventDefault();
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        function password_show_hide() {
            var input_box = document.getElementById("password");
            var show = document.getElementById("show");
            var hide = document.getElementById("hide");

            if (input_box.type === "password") {
                input_box.type = "text";
                show.classList.remove("hidden");
                hide.classList.add("hidden");
            } else {
                input_box.type = "password";
                hide.classList.remove("hidden");
                show.classList.add("hidden");
            }
        }

        function cpassword_show_hide() {
            var input_box = document.getElementById("cpassword");
            var cshow = document.getElementById("cshow");
            var chide = document.getElementById("chide");

            if (input_box.type === "password") {
                input_box.type = "text";
                cshow.classList.remove("hidden");
                chide.classList.add("hidden");
            } else {
                input_box.type = "password";
                chide.classList.remove("hidden");
                cshow.classList.add("hidden");
            }
        }
    </script>
@endsection