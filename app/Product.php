<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','name', 'detail','quantity','price','item1','item2','item3'
    ];
}
