<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['head_id', 'product_name', 'manufacture', 'units', 'price'];

    public function head()
    {
        return $this->belongsTo(Head::class, 'head_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
