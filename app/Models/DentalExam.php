<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'date_created',
        'date_updated',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_created' => 'date:m-d-Y',
        'date_updated' => 'date:m-d-Y',
    ];

    //where this model belong to other model
    public function record(){
        return $this->belongsTo(Record::class);
    }

    //how many relationship does this model have with other models
    public function dental_exam_result()
    {
        return $this->hasOne(DentalExamResult::class);
    }
}
