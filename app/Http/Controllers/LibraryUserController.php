<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibraryUserRequest;
use App\Http\Requests\UpdateLibraryUserRequest;
use App\Models\Library;
use App\Models\LibraryUser;
use Illuminate\Http\Request;

class LibraryUserController extends Controller
{
    public function add(Request $request, Library $library) {
        try {
            $libraryUser = $library->libraryUsers()->create($request->all());
            
            return redirect()->back()->with('library-updated', 'Library User Added!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Library User Not Added!');
        }
    }

    public function remove(LibraryUser $libraryUser) {
        try {
            $libraryUser->delete();
    
            return redirect()->back()->with('library-updated', 'Library User Removed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Library User Not Added!');
        }
    }
}
