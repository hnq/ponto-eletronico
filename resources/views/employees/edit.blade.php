@extends('layout.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Funcionário
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nome completo -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="'Nome Completo'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                                      value="{{ old('name', $employee->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- CPF -->
                    <div class="mb-4">
                        <x-input-label for="cpf" :value="'CPF'" />
                        <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" 
                                      value="{{ old('cpf', $employee->cpf) }}" required />
                        <x-input-error :messages="$errors->get('cpf')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="'E-mail'" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
                                      value="{{ old('email', $employee->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Cargo -->
                    <div class="mb-4">
                        <x-input-label for="position" :value="'Cargo'" />
                        <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" 
                                      value="{{ old('position', $employee->position) }}" required />
                        <x-input-error :messages="$errors->get('position')" class="mt-1" />
                    </div>

                    <!-- Data de nascimento -->
                    <div class="mb-4">
                        <x-input-label for="birth_date" :value="'Data de Nascimento'" />
                        <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" 
                                      value="{{ old('birth_date', $employee->birth_date ? $employee->birth_date->format('Y-m-d') : '') }}" />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-1" />
                    </div>

                    <!-- CEP -->
                    <div class="mb-4">
                        <x-input-label for="cep" :value="'CEP'" />
                        <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" 
                                      value="{{ old('cep', $employee->cep) }}" />
                        <x-input-error :messages="$errors->get('cep')" class="mt-1" />
                    </div>

                    <!-- Endereço -->
                    <div class="mb-4">
                        <x-input-label for="address" :value="'Endereço completo'" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" 
                                      value="{{ old('address', $employee->address) }}" />
                        <x-input-error :messages="$errors->get('address')" class="mt-1" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('employees.index') }}" class="mr-4 underline text-gray-600 hover:text-gray-900">Cancelar</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Atualizar Funcionário
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
