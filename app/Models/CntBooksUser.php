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

    public function user() {
        return $this->belongsTo(TblUser::class, 'user_number', 'user_number');
    }

    public function book() {
        return $this->belongsTo(TblBook::class, 'book_number', 'book_number');
    }
        
}