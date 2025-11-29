<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'vehicle_number'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
