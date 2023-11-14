<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_info_id',
        'add_quantity',
    ];
    
    //how many relationship does this model have with other models
    public function inventory_info()
    {
        return $this->belongsTo(InventoryInfo::class);
    }
}
