<form method="post" action="{{ route('libraries.store') }}" class="space-y-6">
    @csrf
    @method('post')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="__('')" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('libraries.index') }}">
            <x-danger-button type="button">{{ __('Cancel') }}</x-danger-button>
        </a>
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>