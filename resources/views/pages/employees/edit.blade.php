<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form role="form" method="POST" action="{{ route('employees.update', array($employee->id)) }}">
                        @method('PATCH ')
                        @csrf
                        <!-- First Name -->
                        <div>
                            <x-label for="first_name" :value="__('First name')" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$employee->first_name" required autofocus />
                        </div>
                        <!-- Last Name -->
                        <div class="mt-4">
                            <x-label for="last_name" :value="__('Last name')" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$employee->last_name" required />
                        </div>
                        <!-- Company -->
                        <div class="mt-4">
                            <x-label for="company_id" :value="__('Company')" />
                            <select name="company_id" id="company-id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? "selected":"" }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email address')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$employee->email" required />
                        </div>
                        <!-- Phone -->
                        <div class="mt-4">
                            <x-label for="phone" :value="__('phone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$employee->phone" />
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