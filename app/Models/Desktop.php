<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desktop extends Model
{
    use HasFactory;

    protected $table = 'desktops';

    protected $fillable = [
        'equipment_id',
        'item_description',
        'category',
        'pc_make',
        'pc_model',
        'asset_number',
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

    protected $dates = ['purchase_date', 'warranty_expiry'];
}
