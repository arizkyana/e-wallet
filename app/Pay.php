<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'table_pay';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_wallet', 
        'total_invoice', 
        'payment_method', 
        'is_confirmed',
        'is_transfered',
    ];
}
