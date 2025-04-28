<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_code',
        'description',
    ];

    public function contents()
    {
        return $this->hasMany(PackageContent::class);
    }
}
