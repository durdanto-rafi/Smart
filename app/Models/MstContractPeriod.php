<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MstContractPeriod
 */
class MstContractPeriod extends Model
{
    protected $table = 'mst_contract_period';

    protected $primaryKey = 'contract_period_number';

	public $timestamps = false;

    protected $fillable = [
        'contract_period_name'
    ];

    protected $guarded = [];

        
}