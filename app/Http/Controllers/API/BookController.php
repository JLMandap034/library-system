<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function books() {
        $books = Book::with('libraryBooks.library', 'histories.user')->get();
        return response()->json(['books' => $books], 200);  
    }
}
