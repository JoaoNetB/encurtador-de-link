@extends('layouts.default')

@section('title', 'Login')
@section('content')
    <h3 class="mt-5 mb-5 text-primary">Digite seus dados para entrar</h3>
    @if(session('danger'))
            <div class="alert alert-danger mt-5 mb-5" role="alert">
                {{ session('danger') }}
            </div>
    @endif
    @if(session('register_success'))
        <div class="alert alert-success mt-5 mb-5" role="alert">
            {{ session('register_success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login.auth') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        @error('email')
            <div class="alert alert-danger mt-3" role="alert">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        @error('password')
            <div class="alert alert-danger mt-3" role="alert">
                {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-primary">Entrar</button>
        <a href="{{ route('login.register') }}" class="btn btn-secondary">Criar conta</a>
    </form>
@endsection
