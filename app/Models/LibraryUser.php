<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryUser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'library_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
