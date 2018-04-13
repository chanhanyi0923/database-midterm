<?php

namespace Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Book;

class BookController extends BaseController
{
    public function index(Request $request, Response $response, array $args)
    {
        $books = Book::all();

        return $this->ci->renderer->render($response, 'book/index.html', [
            'books' => $books,
        ]);
    }

    public function show(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $book = Book::findOrFail($id);

        return $this->ci->renderer->render($response, 'book/show.html', [
            'book' => $book,
        ]);
    }

    public function create(Request $request, Response $response, array $args)
    {
        return $this->ci->renderer->render($response, 'book/create.html');
    }

    public function store(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();

        $book = Book::insert((object)[
            'name' => $data['name'],
        ]);

        return $response->withRedirect('/book/'.$book->id);
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $book = Book::findOrFail($id);

        return $this->ci->renderer->render($response, 'book/edit.html', [
            'book' => $book,
        ]);
    }

    public function update(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $book = Book::findOrFail($id);

        $data = $request->getParsedBody();

        $book->name = $data['name'];
        Book::update($book);

        return $response->withRedirect('/book/'.$book->id);
    }

    public function destroy(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $book = Book::findOrFail($id);
        Book::destroy($book->id);

        return 'succeeded';
//        return $response->withRedirect('/book/'.$book->id);
    }
}
