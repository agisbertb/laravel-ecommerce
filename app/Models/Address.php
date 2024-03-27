<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'default',
    ];

    protected $casts = [
        'type' => AddressType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

    enum AddressType: string
    {
        case Shipping = 'Shipping';
        case Billing = 'Billing';
    }


