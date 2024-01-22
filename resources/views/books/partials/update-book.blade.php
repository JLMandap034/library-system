<form method="post" action="{{ route('books.update', $book) }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $book->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="author" :value="__('Author')" />
        <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" required autofocus autocomplete="author" />
        <x-input-error class="mt-2" :messages="$errors->get('author')" />
    </div>

    <div>
        <x-input-label for="published_at" :value="__('Published At')" />
        <x-text-input id="published_at" name="published_at" type="text" class="mt-1 block w-full" :value="old('published_at', $book->published_at)" required autofocus autocomplete="published_at" placeholder="YYYY-MM-DD" />
        <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('books.index') }}">
            <x-danger-button type="button">{{ __('Cancel') }}</x-danger-button>
        </a>
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>