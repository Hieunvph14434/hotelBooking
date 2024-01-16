<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'image',
        'type',
        'price',
        'acreage',
        'status',
        'room_no'
    ];

    public function roomType() {
        return $this->hasOne(Category:: class, 'id', 'type');
    }
}
