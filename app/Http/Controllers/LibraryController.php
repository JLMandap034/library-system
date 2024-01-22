<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Models\Book;
use App\Models\Library;
use App\Models\User;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libraries = Library::withTrashed()->paginate(10);

        return view('libraries.index', [
            'libraries' => $libraries,
            'columns' => ['Name', 'Number of Users', 'Number of Books', 'Action'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libraries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibraryRequest $request)
    {
        try {
            $data = $request->all();
            Library::create($data)->save();
    
            return redirect()->route('libraries.index')->with('library-created', 'Library Created!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        $usersList = User::where('is_admin', 0)->whereNotIn('id', $library->libraryUsers->pluck('user_id'))->get();
        $booksList = Book::whereNotIn('id', $library->libraryBooks->pluck('book_id'))->get();

        return view('libraries.edit', [
            'usersList' => $usersList,
            'booksList' => $booksList,
            'library' => $library,
            'users' => $library->libraryUsers()->with('user')->paginate(5),
            'books' => $library->libraryBooks()->with('book')->paginate(5)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLibraryRequest $request, Library $library)
    {
        try {
            $data = $request->all();
            $library->update($data);
    
            return redirect()->route('libraries.edit', $library)->with('library-updated', 'Library Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        try {
            $library->delete();
            
            return redirect()->route('libraries.index')->with('library-deleted', 'Library Deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function restore(Library $library)
    {
        try {
            $library->withTrashed()->restore();
            
            return redirect()->route('libraries.index')->with('library-restored', 'Library Restored!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
