<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::withTrashed()->paginate(10);

        return view('books.index', [
            'books' => $books,
            'columns' => ['Name', 'Author', 'Published At', 'Action'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->all();
        Book::create($data)->save();

        return redirect()->route('books.index')->with('book-created', 'Book Created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->all();
        $book->update($data);

        return redirect()->route('books.edit', $book)->with('book-updated', 'Book Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        
        return redirect()->route('books.index')->with('book-deleted', 'Book Deleted!');
    }

    public function restore(Book $book)
    {
        $book->withTrashed()->restore();
        
        return redirect()->route('books.index')->with('book-restored', 'Book Restored!');
    }
}
