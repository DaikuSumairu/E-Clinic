<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_exam_id',
        'fh_bronchial_asthma',
        'fh_diabetes_mellitus',
        'fh_thyroid_disease',
        'fh_opthalmologic_disease',
        'fh_cancer',
        'fh_cardiac_disorder',
        'fh_hypertension',
        'fh_tuberculosis',
        'fh_nervous_disorder',
        'fh_musculoskeletal',
        'fh_liver_disease',
        'fh_kidney_disease',
    ];

    //where this model belong to other model
    public function medical_exam(){
        return $this->belongsTo(MedicalExam::class);
    }

    //how many relationship does this model have with other models
    public function fh_finding()
    {
        return $this->hasOne(FamilyHistoryFinding::class);
    }
}
