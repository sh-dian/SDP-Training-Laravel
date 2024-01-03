<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type_id',
        'photo_path',
    ];

    public function courtBookings()
    {
        return $this->hasMany(CourtBooking::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
