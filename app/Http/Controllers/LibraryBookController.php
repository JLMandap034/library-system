<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use App\Models\LibraryBook;
use Illuminate\Http\Request;

class LibraryBookController extends Controller
{
    public function show(Library $library) {
        $books = $library->libraryBooks()->paginate(10);

        return view('library-books.show', [
            'books' => $books,
            'library' => $library,
            'columns' => ['Name', 'Author', 'Published At', 'Action'],
        ]);
    }

    public function borrow(LibraryBook $libraryBook) {
        if (!$libraryBook->user_id) {
            $libraryBook->update([
                'user_id' => auth()->user()->id
            ]);
            
            $history = $libraryBook->book->histories()->create([
                'book_id' => $libraryBook->book->id,
                'user_id' => auth()->user()->id,
                'borrowed_at' => now()
            ]);
            $history->save();
    
            return redirect()->route('library-books.show', $libraryBook->library)->with('book-borrowed', 'Book Borrowed Successfully!');
        }
        return redirect()->route('library-books.show', $libraryBook->library)->with('book-not-borrowed', 'Book Borrowed Failed!');
    }

    public function add(Request $request, Library $library) {
        try {
            $libraryBook = $library->libraryBooks()->create($request->all());
            
            return redirect()->route('libraries.edit', $library)->with('library-updated', 'Library Book Added!');
        } catch (\Throwable $th) {
            return redirect()->route('libraries.edit', $library)->with('error', 'Library Book Not Added!');
        }
    }

    public function return(LibraryBook $libraryBook) {
        $libraryBook->update([
            'user_id' => null
        ]);

        $libraryBook->book->histories->first()->update([
            'returned_at' => now()
        ]);

        return redirect()->back()->with('book-returned', 'Book Return Successfully!');
    }

    public function remove(LibraryBook $libraryBook) {
        $libraryBook->delete();

        return redirect()->back()->with('library-updated', 'Library Book Removed!');
    }
}
