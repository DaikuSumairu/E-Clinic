<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    
    //how many relationship does this model have with other models
    public function inventory_info()
    {
        return $this->hasOne(InventoryInfo::class);
    }
}
