<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name',
        'description',
        'quantity', // ✅ Add this line
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];
    
    
}
