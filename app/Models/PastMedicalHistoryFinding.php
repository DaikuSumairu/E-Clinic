<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastMedicalHistoryFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'past_medical_history_id',
        'pmh_allergies_findings',
        'pmh_skin_disease_findings',
        'pmh_opthalmologic_disorder_findings',
        'pmh_ent_disorder_findings',
        'pmh_bronchial_asthma_findings',
        'pmh_cardiac_disorder_findings',
        'pmh_diabetes_mellitus_findings',
        'pmh_chronic_headache_findings',
        'pmh_hepatitis_findings',
        'pmh_hypertension_findings',
        'pmh_thyroid_disorder_findings',
        'pmh_blood_disorder_findings',
        'pmh_tuberculosis_findings',
        'pmh_peptic_ulcer_findings',
        'pmh_musculoskeletal_disorder_findings',
        'pmh_infectious_disease_findings',
        'pmh_others',
    ];

    //where this model belong to other model
    public function past_medical_history(){
        return $this->belongsTo(PastMedicalHistory::class);
    }
}
