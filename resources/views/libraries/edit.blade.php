<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    @if (session('library-updated'))
                        <x-auth-session-status class="mb-4" :status="session('library-updated')" />
                    @endif
                    @if (session('library-not-updated'))
                        <x-auth-session-status class="mb-4" :status="session('library-not-updated')" />
                    @endif
                    @if (session('book-returned'))
                        <x-auth-session-status class="mb-4" :status="session('book-returned')" />
                    @endif

                    @include('libraries.partials.update-library')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>