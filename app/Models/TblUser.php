<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblUser
 */
class TblUser extends Model
{
    protected $table = 'tbl_user';

    protected $primaryKey = 'user_number';

	public $timestamps = false;

    protected $fillable = [
        'user_number',
        'name',
        'flg_multi_login',
        'company_number',
        'password',
        'enable',
        'contract_start_day',
        'contract_period_day'
    ];

    protected $guarded = [];

        
}