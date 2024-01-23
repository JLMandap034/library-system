<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Borrowed Books') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                @foreach($columns as $column)
                                    <th scope="col" class="px-6 py-3">
                                      {{ $column }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $item)
                                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->library->name }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->book->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->book->author }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->book->publishedAt() }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($item->user_id == auth()->user()->id)
                                        <form method="POST" action="{{ route('library-books.return', $item) }}" style="display: inline;">
                                            @csrf
                                            
                                            <x-primary-button :href="route('library-books.return', $item)"
                                                            onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                {{ __('Return') }}
                                            </x-primary-button>
                                        </form>
                                        @else
                                        <form method="POST" action="{{ route('library-books.borrow', $item) }}" style="display: inline;">
                                            @csrf
                                            
                                            <x-info-button :disable="!$item->user_id ? '' : __('disabled')" :href="route('library-books.borrow', $item)"
                                                            onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                {{ __('Borrow') }}
                                            </x-info-button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td colspan="5" scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ __('No Books Found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="py-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
