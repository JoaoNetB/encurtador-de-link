@extends('layouts.default')

@section('title', 'Painel do Usuário')
@section('content')
    <h1 class="text-primary mt-5">Bem-vindo ao painel admin<h1>
            <p class="text-secondary fs-5">Crie e gerencie seus links aqui</p>

            <div class="buttons">
                <a class="btn btn-outline-primary mt-5" href="{{ route('panel.create') }}" role="button">Criar novo link</a>
            </div>

            @if(session('delete_success'))
                <div class="alert alert-success mt-3 mb-3" role="alert">
                    <p class="fs-5">{{ session('delete_success') }}</p> 
                </div>
            @endif

            @if(session('delete_error'))
                <div class="alert alert-danger mt-3 mb-3" role="alert">
                    <p class="fs-5">{{ session('delete_error') }}</p>
                </div>
            @endif

            <h2 class="text-dark fs-4 mt-5">Lista de Links em uso</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Link encurtado</th>
                            <th scope="col">Link original</th>
                            <th scope="col">Acessos</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($links as $link)
                            <tr>
                                <td>{{ route('home.index') }}/l/{{ $code_user.$link->code_url }}</td>
                                <td>{{ $link->source_url }}</td>
                                <td>{{ $link->number_requests }}</td>
                                <td><a href="{{route('panel.delete', $link->code_url) }}" class="link-danger"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endsection
