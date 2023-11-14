<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObGyneReviewFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'ob_gyne_review_id',
        'obg_lnmp_findings',
        'obg_ob_score_findings',
        'obg_abnormal_pregnancies_findings',
        'obg_last_delivery_findings',
        'obg_breast_uterus_ovaries_findings',
        'rs_skin_findings',
        'rs_opthalmologic_findings',
        'rs_ent_findings',
        'rs_cardiovascular_findings',
        'rs_respiratory_findings',
        'rs_gastro_intestinal_findings',
        'rs_neuro_psychiatric_findings',
        'rs_hematology_findings',
        'rs_genitourinary_findings',
        'rs_musculo_skeletal_findings',
    ];

    //where this model belong to other model
    public function ob_gyne_review(){
        return $this->belongsTo(OBGyneReview::class);
    }
}
