<?php

namespace App\Models;

use App\Models\DivisionOffice;
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
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function division()
    {
        return $this->belongsTo(DivisionOffice::class, 'division_id', 'division_id');
    }
}
