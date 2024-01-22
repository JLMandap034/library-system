<form method="post" action="{{ route('libraries.update', $library) }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $library->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-primary-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'add-library-user')"
        >{{ __('Add User') }}</x-primary-button>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                  {{ __('User/s') }}
                </th>
                <th scope="col" class="px-6 py-3">
                  {{ __('Action') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $item)
                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->user->name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('library-users.remove',  $item) }}">
                            <x-danger-button type="button">
                                {{ __('Remove') }}
                            </x-danger-button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="2" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ __('No Users Found') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="py-2">
        {{ $users->links() }}
    </div>

    <hr>

    <div>
        <x-primary-button 
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'add-library-book')"
        >{{ __('Add Book') }}</x-primary-button>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                  {{ __('Book') }}
                </th>
                <th scope="col" class="px-6 py-3">
                  {{ __('Borrowed By') }}
                </th>
                <th scope="col" class="px-6 py-3">
                  {{ __('Borrowed At') }}
                </th>
                <th scope="col" class="px-6 py-3">
                  {{ __('Action') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $item)
                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->book->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->latestBorrower() }}
                    </td>
                    <td class="px-6 py-4">
                       {{ $item->latestBorrower() }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('library-books.return',  $item) }}">
                            <x-primary-button :disable="$item->user_id ? '' : __('disabled')" type="button">
                                {{ __('Mark as Returned') }}
                            </x-primary-button>
                        </a>

                        <a href="{{ route('books.edit', $item->book) }}">
                            <x-info-button type="button">
                                {{ __('View') }}
                            </x-info-button>
                        </a>
                        
                        <a href="{{ route('library-books.remove',  $item) }}">
                            <x-danger-button type="button">
                                {{ __('Remove') }}
                            </x-danger-button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="4" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ __('No Books Found') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="py-2">
        {{ $books->links() }}
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('libraries.index') }}">
            <x-danger-button type="button">{{ __('Cancel') }}</x-danger-button>
        </a>
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>

<x-modal name="add-library-user" focusable>
    <form method="post" action="{{ route('library-users.add', $library) }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Library User') }}
        </h2>

        <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected disabled>Choose a user</option>
            @foreach($usersList as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <div class="mt-6">
            {{-- <x-input-error :messages="$errors" class="mt-2" /> --}}
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3">
                {{ __('Add User') }}
            </x-success-button>
        </div>
    </form>
</x-modal>

<x-modal name="add-library-book" focusable>
    <form method="post" action="{{ route('library-books.add', $library) }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Library Book') }}
        </h2>

        <select id="book_id" name="book_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected disabled>Choose a book</option>
            @foreach($booksList as $book)
                <option value="{{ $book->id }}">{{ $book->name }}</option>
            @endforeach
        </select>

        <div class="mt-6">
            {{-- <x-input-error :messages="$errors" class="mt-2" /> --}}
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3">
                {{ __('Add Book') }}
            </x-success-button>
        </div>
    </form>
</x-modal>