<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'invoice_no' ,'discount','transaction_date', 'total_before', 'discount_amount' , 'final_total', 'status'
    ];
}
