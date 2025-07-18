<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageContent extends Model
{
    protected $fillable = [
        'package_type_id',
        'package_id', // 👈 ADD THIS!
        'item_name',
        'quantity',
        'description',
    ];

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

