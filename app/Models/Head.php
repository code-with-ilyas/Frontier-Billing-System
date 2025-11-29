<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    use HasFactory;

    protected $fillable = ['head_name', 'unit', 'price'];

    public function products()
    {
        return $this->hasMany(Product::class, 'head_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
