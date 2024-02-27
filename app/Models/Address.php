<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'type',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'default',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
