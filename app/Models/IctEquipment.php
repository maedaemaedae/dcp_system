<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IctEquipment extends Model
{
    protected $table = 'ict_equipment';

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

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
    ];
}
