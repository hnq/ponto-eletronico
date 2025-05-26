@extends('layouts.app')

@section('title', 'Funcionários')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <a href="{{ route('employees.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Novo Funcionário
            </a>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Cargo</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $employee->name }}</td>
                                <td class="px-4 py-2">{{ $employee->email }}</td>
                                <td class="px-4 py-2">{{ $employee->position }}</td>
                                <td class="px-4 py-2 flex gap-2 justify-center">
                                    <a href="{{ route('employees.edit', $employee) }}" class="text-blue-600">Editar</a>
                                    <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600"
                                                onclick="return confirm('Tem certeza que deseja remover?')">Remover</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center">Nenhum funcionário cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
