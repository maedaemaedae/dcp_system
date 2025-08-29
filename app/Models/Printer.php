<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;

    protected $table = 'printers';

    protected $fillable = [
        'equipment_id',
        'item_description',
        'category',
        'brand',
        'model',
        'network_ip',
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
