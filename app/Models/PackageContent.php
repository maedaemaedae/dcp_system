<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_type_id',
        'item_id',
        'quantity',
    ];

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }
}
