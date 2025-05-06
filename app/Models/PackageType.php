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

        public function projects()
    {
        return $this->belongsToMany(Project::class, 'package_type_project', 'package_type_id', 'project_id');
    }
}
