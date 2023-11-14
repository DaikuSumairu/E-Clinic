<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastMedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_exam_id',
        'pmh_allergies',
        'pmh_skin_disease',
        'pmh_opthalmologic_disorder',
        'pmh_ent_disorder',
        'pmh_bronchial_asthma',
        'pmh_cardiac_disorder',
        'pmh_diabetes_mellitus',
        'pmh_chronic_headache',
        'pmh_hepatitis',
        'pmh_hypertension',
        'pmh_thyroid_disorder',
        'pmh_blood_disorder',
        'pmh_tuberculosis',
        'pmh_peptic_ulcer',
        'pmh_musculoskeletal_disorder',
        'pmh_infectious_disease',
    ] ;

    //where this model belong to other model
    public function medical_exam(){
        return $this->belongsTo(MedicalExam::class);
    }

    //how many relationship does this model have with other models
    public function pmh_finding()
    {
        return $this->hasOne(PastMedicalHistoryFinding::class);
    }
}
