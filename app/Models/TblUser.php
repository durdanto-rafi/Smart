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
        'name',
        'flg_multi_login',
        'access_code1',
        'access_code2',
        'company_number',
        'password',
        'enable',
        'contract_start_day',
        'contract_period_day'
    ];

    protected $guarded = [];

        
}