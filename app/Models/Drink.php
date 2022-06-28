<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $table = 'drinks';
    protected $fillable = [
        'drink_name',
        'num_of_drink',
        'drink_price'
    ];
}
