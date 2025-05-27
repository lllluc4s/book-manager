<?php
namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::withCount('books')->latest()->paginate(10);

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'   => 'required|string|max:255',
            'estado' => 'nullable|boolean',
        ]);

        $data           = $request->only(['nome']);
        $data['estado'] = $request->has('estado') && '1' == $request->estado;

        Author::create($data);

        return redirect()->route('authors.index')
            ->with('success', 'Autor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'nome'   => 'required|string|max:255',
            'estado' => 'nullable|boolean',
        ]);

        $data           = $request->only(['nome']);
        $data['estado'] = $request->has('estado') && '1' == $request->estado;

        $author->update($data);

        return redirect()->route('authors.index')
            ->with('success', 'Autor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        // Verificar se o autor possui livros associados
        if ($author->books()->count() > 0) {
            return redirect()->route('authors.index')
                ->with('error', 'Não é possível excluir este autor pois ele possui livros associados. Remova os livros primeiro ou transfira-os para outro autor.');
        }

        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Autor excluído com sucesso!');
    }
}
