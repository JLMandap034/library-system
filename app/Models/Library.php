<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
    ];

    public function libraryUsers() {
        return $this->hasMany(LibraryUser::class);
    }

    public function libraryBooks() {
        return $this->hasMany(LibraryBook::class);
    }
}
