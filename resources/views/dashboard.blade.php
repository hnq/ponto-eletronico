@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Bem-vindo ao Sistema de Registro de Ponto
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <p class="mb-6 text-lg">
                Olá, <strong>{{ auth()->user()->name }}</strong>! Você está logado no sistema de ponto eletrônico.
            </p>

            <div class="row g-4">
                <!-- Registrar Ponto -->
                <div class="col-md-4">
                    <a href="{{ route('ponto.registrar') }}"
                       class="btn btn-primary d-flex flex-column align-items-center p-4"
                       style="min-height: 180px;">
                        <img src="{{ asset('images/clock.png') }}" alt="" style="width:64px;height:64px;margin-bottom:10px;">
                        <span class="fs-4">Registrar Ponto</span>
                    </a>
                </div>

                <!-- Gerenciar Funcionários (só admin) -->
                @if(auth()->user()->isAdmin())
                <div class="col-md-4">
                    <a href="{{ route('funcionarios.index') }}"
                       class="btn btn-success d-flex flex-column align-items-center p-4"
                       style="min-height: 180px;">
                        <img src="{{ asset('images/users.png') }}" alt="" style="width:64px;height:64px;margin-bottom:10px;">
                        <span class="fs-4">Funcionários</span>
                    </a>
                </div>
                @endif

                <!-- Trocar Senha -->
                <div class="col-md-4">
                    <a href="{{ route('password.change') }}"
                       class="btn btn-warning d-flex flex-column align-items-center p-4"
                       style="min-height: 180px;">
                        <img src="{{ asset('images/key.png') }}" alt="" style="width:64px;height:64px;margin-bottom:10px;">
                        <span class="fs-4">Trocar Senha</span>
                    </a>
                </div>

                <!-- Relatorios -->
                <div class="col-md-4">
                    <a href="{{ route('points.report') }}"
                       class="btn btn-warning d-flex flex-column align-items-center p-4"
                       style="min-height: 180px;">
                        <img src="{{ asset('images/report.png') }}" alt="" style="width:64px;height:64px;margin-bottom:10px;">
                        <span class="fs-4">Relatorios</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
