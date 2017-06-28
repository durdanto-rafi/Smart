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
        'book_number',
        'name',
        'image_pass',
        'subject_number',
        'grade_number',
        'book_url',
        'vertical_index'
    ];

    protected $guarded = [];

    public function subject() {
        return $this->belongsTo(MstSubject::class, 'subject_number', 'subject_number');
    }

    public function grade() {
        return $this->belongsTo(MstGrade::class, 'grade_number', 'grade_number');
    }  
}