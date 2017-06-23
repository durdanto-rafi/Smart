<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblCompany
 */
class TblCompany extends Model
{
    protected $table = 'tbl_company';

    protected $primaryKey = 'company_number';

	public $timestamps = false;

    protected $fillable = [
        'name', 'company_number'
    ];

    protected $guarded = [];

        
}