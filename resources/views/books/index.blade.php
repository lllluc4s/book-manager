@extends('layouts.app')

@section('title', 'Lista de Livros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-book"></i> Lista de Livros</h1>
    @if(auth()->user()->canManage())
        <a href="{{ route('books.create') }}" class="btn btn-custom-primary">
            <i class="bi bi-plus-circle"></i> Novo Livro
        </a>
    @endif
</div>

@if($books->count() > 0)
    <div class="row row-uniform-height">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100 book-card card-uniform-height">
                    <div class="text-center pt-3 book-cover-container">
                        <img src="{{ $book->capa ? asset('storage/' . $book->capa) : asset('images/default-book-cover.svg') }}" 
                             alt="Capa de {{ $book->titulo }}" 
                             class="rounded book-cover-image"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="card-content flex-grow-1">
                            <h5 class="card-title">{{ $book->titulo }}</h5>
                            <p class="card-text text-muted mb-2">
                                <i class="bi bi-person"></i> {{ $book->author->nome }}
                            </p>
                            <p class="card-text text-muted mb-2">
                                <i class="bi bi-calendar"></i> {{ $book->data_publicacao->format('d/m/Y') }}
                            </p>
                            <p class="card-text">{{ Str::limit($book->descricao, 100) }}</p>
                        </div>
                        <div class="book-actions-centered mt-3">
                            <div class="btn-action-horizontal d-flex justify-content-center gap-2">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-action btn-view" title="Ver detalhes">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(auth()->user()->canManage())
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-action btn-edit" title="Editar livro">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-delete" title="Excluir livro">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="pagination-wrapper">
        {{ $books->links('pagination::custom') }}
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-book display-1 text-muted"></i>
        <h3 class="text-muted mt-3">Nenhum livro encontrado</h3>
        <p class="text-muted">Comece adicionando seu primeiro livro!</p>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Adicionar Livro
        </a>
    </div>
@endif
@endsection
