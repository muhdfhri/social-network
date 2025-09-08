{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Sebelum memulai, Anda harus memverifikasi alamat email Anda dengan mengklik link yang kami kirimkan ke alamat email Anda? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan email lainnya.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('Kirim Ulang Link Verifikasi') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('title', 'Verifikasi Email')
@section('content')
    <div class="flex h-screen">
        <div class="container px-6 mx-auto flex justify-center items-center">
            <div
                class="p-4 bg-gray-100 rounded-lg shadow-xl w-2/3 dark:bg-gray-800 flex flex-col items-center border-t-8 border-blue-600">
                <h3 class="text-center text-black pb-2 text-xl font-bold sm:text-2xl">Verifikasi Alamat Email Anda
                </h3>
                <span class="bg-blue-500 mx-auto mb-6 inline-block h-1 w-10 rounded"></span>
                <p class="text-gray-400 mb-6 lead w-2/3 text-center">
                    {{ __('Terima kasih telah mendaftar!') }}
                    <br />
                    {{ __('Sebelum memulai, Anda harus memverifikasi alamat email Anda dengan mengklik link yang kami kirimkan ke alamat email Anda? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan email lainnya.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert').remove();
                        }, 5000);
                    </script>
                    <div
                        class="alert px-4 py-2 mb-6 bg-blue-600 rounded-full flex justify-center text-blue-100 lead lg:rounded-full flex lg:inline-flex">
                        <span class="font-semibold text-sm">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}</span>
                    </div>
                @endif

                <div class="flex flex-row gap-6">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit"
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                {{ __('Kirim Ulang Link Verifikasi') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
