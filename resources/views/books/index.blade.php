<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="py-6">
                        <a href="{{ route('books.create') }}">
                            <x-primary-button>{{ __('Add') }}</x-primary-button>
                        </a>
                    </div>
                    @if (session('book-created'))
                        <x-auth-session-status class="mb-4 py-6" :status="session('book-created')" />
                    @endif
                    @if (session('book-deleted'))
                        <x-auth-session-status class="mb-4 py-6" :status="session('book-deleted')" />
                    @endif
                    @if (session('book-restored'))
                        <x-auth-session-status class="mb-4 py-6" :status="session('book-restored')" />
                    @endif
                    @if (session('error'))
                        <x-auth-session-status class="mb-4 py-6" :status="session('error')" />
                    @endif

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
                            @forelse($books as $book)
                                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $book->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $book->author }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $book->publishedAt() }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('books.edit', $book) }}">
                                            <x-info-button>
                                                {{ __('Edit') }}
                                            </x-info-button>
                                        </a>

                                        @if(!$book->deleted_at)
                                            <form method="POST" action="{{ route('books.destroy', $book) }}" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                
                                                <x-danger-button :href="route('books.destroy', $book)"
                                                                onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('books.restore', $book) }}" style="display: inline;">
                                                @csrf
                                                
                                                <x-success-button :href="route('books.restore', $book)"
                                                                onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                    {{ __('Restore') }}
                                                </x-success-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td colspan="4" scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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