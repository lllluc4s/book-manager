@extends('layouts.app')

@section('title', $book->titulo)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-book"></i> {{ $book->titulo }}</h4>
                    @if(auth()->user()->canManage())
                        <div class="btn-action-group">
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-action-vertical btn-edit" title="Editar livro">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action-vertical btn-delete" title="Excluir livro">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <h6 class="text-muted">Capa</h6>
                        <div class="book-cover-container">
                            <img src="{{ $book->capa ? asset('storage/' . $book->capa) : asset('images/default-book-cover.svg') }}" 
                                 alt="Capa de {{ $book->titulo }}" 
                                 class="img-fluid rounded shadow-sm book-cover-image"
                                 style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-9">
                    @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Autor</h6>
                                <p class="mb-3">
                                    <i class="bi bi-person"></i> 
                                    <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                                        {{ $book->author->nome }}
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Data de Publicação</h6>
                                <p class="mb-3">
                                    <i class="bi bi-calendar"></i> {{ $book->data_publicacao->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <h6 class="text-muted">Descrição</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($book->descricao)) !!}
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('books.index') }}" class="btn btn-custom-outline">
                        <i class="bi bi-arrow-left"></i> Voltar à Lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
