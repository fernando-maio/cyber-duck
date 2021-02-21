<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('companies.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right">
                        <i class="fas fa-plus"></i> {{ __('Add New') }}
                    </a>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    @if(count($companies))
                        <table class="table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">{{ __('Name') }}</th>
                                    <th class="px-4 py-2">{{ __('Email') }}</th>
                                    <th class="px-4 py-2">{{ __('Has Logo') }}</th>
                                    <th class="px-4 py-2">{{ __('Website') }}</th>
                                    <th class="px-4 py-2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $key => $company)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $company->name }}</td>
                                        <td class="border px-4 py-2">{{ $company->email }}</td>
                                        <td class="border px-4 py-2">{!! $company->logo ? __('Yes') : __('No') !!}</td>
                                        <td class="border px-4 py-2">{{ $company->website }}</td>
                                        <td class="border px-4 py-2">
                                            <form role="form" method="POST" action="{{ route('companies.remove', array($company->id)) }}">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('companies.edit', array($company->id)) }}" id="btn-edit" class="text-blue-500 hover:bg-gray-200 py-1 px-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="text-red-700 py-1 px-2 hover:bg-gray-200" onclick="return confirm('{{ __('Do you really want to remove this company?') }}');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $companies->links() }}
                        </div>
                    @else
                        <h6>
                            {{ __('Any result was found') }} :(
                        </h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
