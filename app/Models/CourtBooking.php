<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'court_id',
        'customer_id',
        'hour',
        'date',
        'start_time',
        'total_player',
        'total_price',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
