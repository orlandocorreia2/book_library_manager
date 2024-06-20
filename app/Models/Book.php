<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'title',
        'year_publication',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'books_authors', 'book_id', 'author_id');
    }
}
