<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->is_admin)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <x-card :title="__('Users')" :button="__('View list')" :link="route('users.index')" />
                            <x-card :title="__('Libraries')" :button="__('View list')" :link="route('libraries.index')" />
                            <x-card :title="__('Books')" :button="__('View list')" :link="route('books.index')" />
                        </div>
                    @else
                        @if(count($libraries) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2">
                                @foreach ($libraries as $library)
                                    <x-card :title="__($library->name)" :button="__('View Books')" :link="route('library-books.show', $library)" />
                                @endforeach
                            </div>
                        @else
                            <div class="grid grid-cols-1">
                                <x-card :title="__('No Libraries')"/>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
