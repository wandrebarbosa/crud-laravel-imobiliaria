<?php

namespace LaraDev;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    protected $fillable = ['title', 'description', 'rental_price', 'sale_price', 'name'];

    public $timestamps = false;

}