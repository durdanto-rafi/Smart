<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CntBooksUser
 */
class CntBooksUser extends Model
{
    protected $table = 'cnt_books_user';

    public $timestamps = false;

    protected $fillable = [
        'user_number',
        'book_number'
    ];

    protected $guarded = [];

        
}