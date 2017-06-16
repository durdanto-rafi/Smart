<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MstSubject
 */
class MstSubject extends Model
{
    protected $table = 'mst_subject';

    protected $primaryKey = 'subject_number';

	public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

        
}