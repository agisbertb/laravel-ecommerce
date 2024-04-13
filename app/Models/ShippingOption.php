<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'estimated_delivery',
    ];
}
