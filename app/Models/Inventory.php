<?php

namespace App\Models;

use App\Models\School;
use App\Models\DivisionOffice; // or App\Models\Division if you made an alias
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'school_id',
        'division_id',
        'item_name',
        'quantity',
        'status',
        'remarks',
        'recipient_id', // ✅ add this
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function division()
    {
        return $this->belongsTo(DivisionOffice::class, 'division_id', 'division_id');
    }

    public function deliveredItems()
    {
        return $this->hasManyThrough(
            \App\Models\DeliveredItem::class,
            \App\Models\Delivery::class,
            'recipient_id', // Foreign key on Delivery
            'delivery_id',  // Foreign key on DeliveredItem
            'recipient_id', // Local key on Inventory
            'id'            // Local key on Delivery
        );
    }

}
