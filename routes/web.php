<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LibraryBookController;
use App\Http\Controllers\LibraryUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('/booklist', [ProfileController::class, 'books'])->name('booklist');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth.admin'])->group(function () {
        Route::resources([
            'users' => UserController::class,
            'libraries' => LibraryController::class,
            'books' => BookController::class,
        ]);

        Route::post('/libraries/restore', [LibraryController::class, 'restore'])->name('libraries.restore');
        Route::post('/books/restore', [BookController::class, 'restore'])->name('books.restore');

        Route::post('/library-books/{library}/add', [LibraryBookController::class, 'add'])->name('library-books.add');
        Route::get('/library-books/remove/{libraryBook}', [LibraryBookController::class, 'remove'])->name('library-books.remove');

        Route::post('/library-users/{library}/add', [LibraryUserController::class, 'add'])->name('library-users.add');
        Route::get('/library-users/remove/{libraryUser}', [LibraryUserController::class, 'remove'])->name('library-users.remove');
    });
    
    Route::get('/library-books/{library}', [LibraryBookController::class, 'show'])->name('library-books.show');
    Route::get('/library-books/return/{libraryBook}', [LibraryBookController::class, 'return'])->name('library-books.return');
    Route::get('/library-books/borrow/{libraryBook}', [LibraryBookController::class, 'borrow'])->name('library-books.borrow');
});

require __DIR__.'/auth.php';
