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
        'network_ip',
        'pc_model',
        'pc_make',
        'pc_sn',
        'monitor_sn',
        'avr_sn',
        'wifi_adapter_sn',
        'keyboard_sn',
        'mouse_sn', 
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