<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyVisitInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_visit_id',
        'main_complaint',
        'sub_complaint',
        'treatment',
        'medicine',
        'medicine_take',
        'take',
    ];

    //where this model belong to other model
    public function daily_visit(){
        return $this->belongsTo(DailyVisit::class);
    }
}
