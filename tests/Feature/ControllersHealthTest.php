<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\User;

describe('Controllers Essenciais', function () {
    beforeEach(function () {
        $this->user      = User::factory()->create();
        $this->adminUser = User::factory()->create(['role' => 'admin']);
    });

    test('página inicial de livros funciona para usuários logados', function () {
        $response = $this->actingAs($this->user)->get(route('books.index'));
        expect($response->status())->toBe(200);
    });

    test('página inicial de autores funciona para usuários logados', function () {
        $response = $this->actingAs($this->user)->get(route('authors.index'));
        expect($response->status())->toBe(200);
    });

    test('pode criar um autor', function () {
        $authorData = [
            'nome'   => 'Autor Teste',
            'estado' => true,
        ];

        $this->actingAs($this->adminUser)
            ->post(route('authors.store'), $authorData)
            ->assertRedirect(route('authors.index'));

        $this->assertDatabaseHas('authors', $authorData);
    });

    test('pode criar um livro', function () {
        $author   = Author::factory()->create();
        $bookData = [
            'titulo'          => 'Livro Teste',
            'descricao'       => 'Descrição do livro',
            'data_publicacao' => '2024-01-01',
            'author_id'       => $author->id,
        ];

        $this->actingAs($this->adminUser)
            ->post(route('books.store'), $bookData)
            ->assertRedirect(route('books.index'));

        $this->assertDatabaseHas('books', [
            'titulo'    => $bookData['titulo'],
            'author_id' => $bookData['author_id'],
            'capa'      => null,
        ]);
    });

    test('api de autores funciona', function () {
        $author = Author::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/authors');

        expect($response->status())->toBe(200);
        expect($response->json('success'))->toBe(true);
    });
});
