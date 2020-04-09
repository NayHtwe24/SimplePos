<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrderLine extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'transaction_id', 'recipes_id','qty', 'sub_sell_price', 'sell_price'

    ];
}
