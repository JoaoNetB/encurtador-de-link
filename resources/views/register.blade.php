@extends('layouts.default')

@section('title', 'Criar conta')
@section('content')
    <h3 class="mt-5 mb-5 text-primary">Digite seus dados para criar conta</h3>
    @if(session('danger'))
            <div class="alert alert-danger mt-5 mb-5" role="alert">
                {{ session('danger') }}
            </div>
    @endif
    <form method="POST" action="{{ route('login.register.create') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        @error('name')
            <div class="alert alert-danger mt-3" role="alert">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        @error('email')
            <div class="alert alert-danger mt-3" role="alert">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        @error('password')
            <div class="alert alert-danger mt-3" role="alert">
                {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-primary">Criar conta</button>
        <a href="{{ route('login.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
