<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id'; // Matches your schema
    public $incrementing = false;      // Since you're manually assigning role_id
    protected $keyType = 'int';        // Explicitly define the type

    protected $fillable = [
        'role_id',
        'role_name',
    ];

    /**
     * Get all users that have this role.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
