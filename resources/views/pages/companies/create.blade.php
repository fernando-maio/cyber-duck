<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form role="form" method="POST" action="{{ route('companies.create') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Company name')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email address')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>
                        <!-- Website -->
                        <div class="mt-4">
                            <x-label for="website" :value="__('Website')" />
                            <x-input id="website" class="block mt-1 w-full" type="text" name="website" :value="old('website')" />
                        </div>
                        <!-- Logo -->
                        <div class="mt-4">
                            <x-label for="logo" :value="__('Logo')" />
                            <x-input id="logo" class="block mt-1 w-full" type="file" name="logo" :value="old('logo')" />
                        </div>
                        <!-- Actions -->
                        <div class="flex items-center justify-end mt-4">
                            <!-- Cancel -->
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('companies') }}">
                                {{ __('Cancel') }}
                            </a>
                            <!-- Submit -->
                            <x-button class="ml-4">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
