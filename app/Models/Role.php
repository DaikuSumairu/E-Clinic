<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'role'
    ];

    //how many relationship does this model have with other models
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
