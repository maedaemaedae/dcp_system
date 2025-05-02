<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ⬅️ make sure this is included

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id'; // still valid if your table uses this

    protected $fillable = [
        'user_id',
        'role_name',
    ];

    /**
     * Get the user that owns this role.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
