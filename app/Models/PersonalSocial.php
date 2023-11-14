<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_exam_id',
        'smoker',
        'day',
        'year',
        'alcoholic',
        'shot',
        'week',
        'medication',
        'med_take',
        'hospitalization',
        'hospitalization_result',
        'operation',
        'operation_result',
    ];

    //where this model belong to other model
    public function medical_exam(){
        return $this->belongsTo(MedicalExam::class);
    }
}
