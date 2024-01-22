<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'library_id',
        'book_id',
        'user_id',
    ];
    
    public function library() {
        return $this->belongsTo(Library::class);
    }
    
    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function latestBorrower() {
        return $this->user_id ? $this->user->name : 'None';
    }

    public function latestBorrowedDate () {
        if ($this->user_id) {
            $borrower = $this->histories->first();
            return date('F d, Y @ h:i:s A', strtotime($borrower->borrowed_at));
        }

        return 'None';
    }
}
