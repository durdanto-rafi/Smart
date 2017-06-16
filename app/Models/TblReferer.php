<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblReferer
 */
class TblReferer extends Model
{
    protected $table = 'tbl_referer';

    protected $primaryKey = 'referer_number';

	public $timestamps = false;

    protected $fillable = [
        'company_number',
        'host',
        'ip_address'
    ];

    protected $guarded = [];

        
}