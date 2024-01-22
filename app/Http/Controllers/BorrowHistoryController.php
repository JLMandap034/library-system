<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowHistoryRequest;
use App\Http\Requests\UpdateBorrowHistoryRequest;
use App\Models\BorrowHistory;

class BorrowHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowHistory $borrowHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowHistory $borrowHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowHistoryRequest $request, BorrowHistory $borrowHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowHistory $borrowHistory)
    {
        //
    }
}
