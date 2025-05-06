<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'projects_id'; // match your DB column
    public $timestamps = false;

    protected $fillable = [
        'school_id',
        'project_name',
        'year',
        'description',
        'created_by',
        'created_date',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class, 'project_id', 'projects_id');
    }
    
        public function packageTypes()
    {
        return $this->belongsToMany(PackageType::class, 'package_type_project', 'project_id', 'package_type_id');
    }
}