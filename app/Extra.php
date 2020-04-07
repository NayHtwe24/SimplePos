<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Extra extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'product_id','price'
    ];
}
