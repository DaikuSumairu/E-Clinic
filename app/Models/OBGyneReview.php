<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObGyneReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_exam_id',
        'obg_lnmp',
        'obg_ob_score',
        'obg_abnormal_pregnancies',
        'obg_last_delivery',
        'obg_breast_uterus_ovaries',
        'rs_skin',
        'rs_opthalmologic',
        'rs_ent',
        'rs_cardiovascular',
        'rs_respiratory',
        'rs_gastro_intestinal',
        'rs_neuro_psychiatric',
        'rs_hematology',
        'rs_genitourinary',
        'rs_musculo_skeletal',
    ];

    //where this model belong to other model
    public function medical_exam(){
        return $this->belongsTo(MedicalExam::class);
    }

    //how many relationship does this model have with other models
    public function obr_finding()
    {
        return $this->hasOne(ObGyneReviewFinding::class);
    }
}
