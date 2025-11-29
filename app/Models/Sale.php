<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'entry_date',
        'bill_month',
        'bill_year',
        'issue_date',
        'customer_name',
        'head_id',
        'product_id',
        'quantity',
        'rate',
        'vehicle_number', // ✅ ADD THIS
    ];

    public function head()
    {
        return $this->belongsTo(Head::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->quantity * $this->rate;
    }

    public function customer()
{
    return $this->belongsTo(Customer::class);
}

public function vehicle()
{
    return $this->belongsTo(Vehicle::class);
}

    
}
