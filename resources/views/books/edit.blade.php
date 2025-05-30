@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Livro</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo', $book->titulo) }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author_id" class="form-label">Autor *</label>
                        <select class="form-select @error('author_id') is-invalid @enderror" 
                                id="author_id" name="author_id" required>
                            <option value="">Selecione um autor</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" 
                                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                    {{ $author->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="data_publicacao" class="form-label">Data de Publicação *</label>
                        <input type="date" class="form-control @error('data_publicacao') is-invalid @enderror" 
                               id="data_publicacao" name="data_publicacao" 
                               value="{{ old('data_publicacao', $book->data_publicacao->format('Y-m-d')) }}" required>
                        @error('data_publicacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição *</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                  id="descricao" name="descricao" rows="5" required>{{ old('descricao', $book->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="capa" class="form-label">Capa do Livro</label>
                        <div class="mb-2">
                            <div class="d-flex align-items-start gap-3">
                                <div class="book-cover-container">
                                    <img src="{{ $book->capa ? asset('storage/' . $book->capa) : asset('images/default-book-cover.svg') }}" alt="Capa atual" class="img-thumbnail book-cover-image" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <div>
                                    <small class="text-muted d-block mb-2">{{ $book->capa ? 'Capa atual' : 'Capa padrão (nenhuma capa enviada)' }}</small>
                                    @if($book->capa)
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removerCapa()">
                                            <i class="bi bi-trash"></i> Remover Capa
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control @error('capa') is-invalid @enderror" 
                               id="capa" name="capa" accept="image/jpeg,image/jpg,image/png">
                        <div class="form-text">
                            Formatos aceitos: JPG, PNG. Tamanho máximo: 2MB. A imagem será redimensionada para 200x200 pixels.
                        </div>
                        @error('capa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-custom-outline">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-custom-primary">
                            <i class="bi bi-check-circle"></i> Atualizar Livro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação para remover capa -->
<div class="modal fade" id="removerCapaModal" tabindex="-1" aria-labelledby="removerCapaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removerCapaModalLabel">Confirmar Remoção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja remover a capa deste livro? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="removerCapaForm" method="POST" action="{{ route('books.removeCapa', $book) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sim, Remover</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function removerCapa() {
    var modal = new bootstrap.Modal(document.getElementById('removerCapaModal'));
    modal.show();
}
</script>
@endsection
