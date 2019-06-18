<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    protected $fillable = [
        'name',	'price','name_restaurant','name_categorie','image','created_by'];
}
