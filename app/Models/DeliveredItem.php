<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveredItem extends Model
{
    use HasFactory;

    protected $fillable = [
    'delivery_id',
    'package_content_id',
    'quantity_delivered',
    ];
    
}
