@extends('layouts.app')

@section('title', 'Novo Funcionário')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Novo Funcionário
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('employees.store') }}">
                    @csrf

                    <!-- Nome completo -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="'Nome Completo'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                                      value="{{ old('name') }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- CPF -->
                    <div class="mb-4">
                        <x-input-label for="cpf" :value="'CPF'" />
                        <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" 
                                      value="{{ old('cpf') }}" required />
                        <x-input-error :messages="$errors->get('cpf')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="'E-mail'" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
                                      value="{{ old('email') }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Senha -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="'Senha'" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Cargo -->
                    <div class="mb-4">
                        <x-input-label for="position" :value="'Cargo'" />
                        <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" 
                                      value="{{ old('position') }}" required />
                        <x-input-error :messages="$errors->get('position')" class="mt-1" />
                    </div>

                    <!-- Data de nascimento -->
                    <div class="mb-4">
                        <x-input-label for="birth_date" :value="'Data de Nascimento'" />
                        <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" 
                                      value="{{ old('birth_date') }}" required />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-1" />
                    </div>

                    <!-- CEP -->
                    <div class="mb-4">
                        <x-input-label for="cep" :value="'CEP'" />
                        <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" 
                                      value="{{ old('cep') }}" required />
                        <x-input-error :messages="$errors->get('cep')" class="mt-1" />
                    </div>

                    <!-- Endereço -->
                    <div class="mb-4">
                        <x-input-label for="address" :value="'Endereço completo'" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" 
                                      value="{{ old('address') }}" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-1" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('employees.index') }}" class="mr-4 underline text-gray-600 hover:text-gray-900">Cancelar</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Criar Funcionário
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cep').addEventListener('blur', function () {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length !== 8) {
                alert('CEP inválido. Por favor, informe um CEP com 8 dígitos.');
                return;
            }

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado.');
                        document.getElementById('address').value = '';
                        return;
                    }
                    // Monta o endereço completo
                    const enderecoCompleto = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                    document.getElementById('address').value = enderecoCompleto;
                })
                .catch(() => {
                    alert('Erro ao buscar o CEP.');
                    document.getElementById('address').value = '';
                });
        });

        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

            let soma = 0, resto;

            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;

            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) return false;

            return true;
        }

        document.getElementById('cpf').addEventListener('blur', function () {
            if (!validarCPF(this.value)) {
                alert('CPF inválido!');
                this.focus();
            }
        });
    </script>
@endsection
