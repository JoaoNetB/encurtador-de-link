@extends('layouts.default')
@section('title', 'Criar link')

@section('content')
    <form method="POST" action="{{ route('panel.create.insert') }}">
        @csrf
        <div class="mb-3">
        <label for="link_source" class="form-label">Link para encurtar</label>
        <input type="text" name="link_source" class="form-control mb-3" id="link_source">
        @error('link_source')
            <div class="alert alert-danger mt-3" role="alert">
                {{ $message }}
            </div>
        @enderror
        <div class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-7">
                <a href="{{ route('panel.index') }}" class="btn btn-outline-primary">Voltar</a>
            </div>
            <div class="col-7">
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>
        </div>
    </form>
@endsection