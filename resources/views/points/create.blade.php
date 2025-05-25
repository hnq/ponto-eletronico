@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Registrar Ponto</h1>
        <br>
        <br>
        <br>
        <br>

        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ponto.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary d-flex align-items-center">
                <img src="{{ asset('images/clock.png') }}" 
                    alt="Registrar" 
                    style="width:24px; height:24px; margin-right:8px;">
                Registrar Agora
            </button>
        </form>

    </div>
@endsection
