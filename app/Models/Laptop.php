<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $table = 'laptops';

    protected $fillable = [
        'equipment_id',
        'item_description',
        'category',
        'brand',
        'model',
        'asset_number',
        'serial_number',
        'location',
        'assigned_to',
        'purchase_date',
        'warranty_expiry',
        'condition',
        'note',
    ];

    protected $dates = ['purchase_date', 'warranty_expiry'];
}
