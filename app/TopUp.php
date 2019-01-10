<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    protected $table = 'table_topup';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_wallet', 
        'topup', 
        'is_paid', 
        'unique_code',
        'id_pay',
        'source'
    ];
}
