<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'daily_name',
        'daily_id',
        'date',
        'time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date:m-d-Y',
        'time' => 'datetime:H:i:s',
    ];

    //where this model belong to other model
    public function user(){
        return $this->belongsTo(User::class);
    }

    //how many relationship does this model have with other models
    public function daily_visit_info()
    {
        return $this->hasMany(DailyVisitInfo::class);
    }
}
