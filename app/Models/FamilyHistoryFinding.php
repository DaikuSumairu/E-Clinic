<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHistoryFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_history_id',
        'fh_bronchial_asthma_findings',
        'fh_diabetes_mellitus_findings',
        'fh_thyroid_disease_findings',
        'fh_opthalmologic_disease_findings',
        'fh_cancer_findings',
        'fh_cardiac_disorder_findings',
        'fh_hypertension_findings',
        'fh_tuberculosis_findings',
        'fh_nervous_disorder_findings',
        'fh_musculoskeletal_findings',
        'fh_liver_disease_findings',
        'fh_kidney_disease_findings',
        'fh_others',
    ];

    //where this model belong to other model
    public function family_history(){
        return $this->belongsTo(FamilyHistory::class);
    }
}
