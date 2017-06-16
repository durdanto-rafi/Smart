<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblBook
 */
class TblBook extends Model
{
    protected $table = 'tbl_books';

    protected $primaryKey = 'book_number';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'image_pass',
        'subject_number',
        'grade_number',
        'book_url',
        'vertical_index'
    ];

    protected $guarded = [];

        
}