<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MstGrade
 */
class MstGrade extends Model
{
    protected $table = 'mst_grade';

    protected $primaryKey = 'grade_number';

	public $timestamps = false;

    protected $fillable = [
        'name','grade_number'
    ];

    protected $guarded = [];

        
}