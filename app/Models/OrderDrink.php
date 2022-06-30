<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDrink extends Model
{
    use HasFactory;
    public function drink()
    {
        return $this->belongsTo(Drink::class, 'drink_id');
    }
}
