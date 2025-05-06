<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $primaryKey = 'packages_id'; // ✅ matches your DB

    protected $fillable = [
        'package_type_id',
        'project_id',
        // Add other fields if needed
    ];

    public function type()
    {
        return $this->belongsTo(PackageType::class, 'package_type_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
