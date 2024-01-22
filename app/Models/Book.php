<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'author',
        'published_at',
    ];

    public function libraryBooks() {
        return $this->hasMany(LibraryBook::class);
    }

    public function histories() {
        return $this->hasMany(BorrowHistory::class)->orderBy('created_at', 'desc');
    }

    public function publishedAt() {
        return date('M d, Y', strtotime($this->published_at));
    }
}
