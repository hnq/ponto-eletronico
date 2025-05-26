@extends('layouts.app')

@section('title', 'Relatório de Registros de Ponto')

@section('content')
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">Relatório de Registros de Ponto</h2>

        <form method="GET" action="{{ url('/points/report') }}" class="mb-6 flex gap-4 items-end">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data Inicial</label>
                <input id="start_date" type="date" name="start_date" value="{{ $startDate }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Data Final</label>
                <input id="end_date" type="date" name="end_date" value="{{ $endDate }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <button type="submit" 
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Filtrar</button>
        </form>

        <div class="overflow-x-auto bg-white shadow rounded-lg p-4">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID Registro</th>
                        <th class="border border-gray-300 px-4 py-2">Nome Funcionário</th>
                        <th class="border border-gray-300 px-4 py-2">Cargo</th>
                        <th class="border border-gray-300 px-4 py-2">Idade</th>
                        <th class="border border-gray-300 px-4 py-2">Nome do Gestor</th>
                        <th class="border border-gray-300 px-4 py-2">Data e Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $record->registro_id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $record->funcionario_nome }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $record->cargo }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $record->idade }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $record->gestor_nome ?? '—' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $record->data_hora_registro }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4">Nenhum registro encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
