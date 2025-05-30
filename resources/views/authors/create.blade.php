@extends('layouts.app')

@section('title', 'Criar Novo Autor')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Criar Novo Autor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('authors.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome *</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                               id="nome" name="nome" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="estado" value="0">
                            <input class="form-check-input" type="checkbox" id="estado" name="estado" value="1" 
                                   {{ old('estado', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="estado">
                                Autor ativo
                            </label>
                        </div>
                        @error('estado')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('authors.index') }}" class="btn btn-custom-primary">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-custom-primary">
                            <i class="bi bi-check-circle"></i> Salvar Autor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
