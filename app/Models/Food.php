<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    protected $table = 'food';
    protected $fillable = [
        'food_name',
        'food_price',
    ];


    use SoftDeletes;
}
