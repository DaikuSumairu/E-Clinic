<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExaminationFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'physical_examination_id',
        'pe_general_appearance_findings',
        'pe_skin_findings',
        'pe_head_scalp_findings',
        'pe_eyes_top_od',
        'pe_eyes_bot_od',
        'pe_eyes_top_os',
        'pe_eyes_bot_os',
        'pe_corrected_top_od',
        'pe_corrected_bot_od',
        'pe_corrected_top_os',
        'pe_corrected_bot_os',
        'pe_pupils_findings',
        'pe_ear_eardrums_findings',
        'pe_nose_sinuses_findings',
        'pe_mouth_throat_findings',
        'pe_neck_thyroid_findings',
        'pe_chest_breast_axilla_findings',
        'pe_heart_cardiovascular_findings',
        'pe_lungs_respiratory_findings',
        'pe_abdomen_findings',
        'pe_back_flanks_findings',
        'pe_anus_rectum_findings',
        'pe_genito_urinary_system_findings',
        'pe_inguinal_genitals_findings',
        'pe_musculo_skeletal_findings',
        'pe_extremities_findings',
        'pe_reflexes_findings',
        'pe_neurological_findings',
        'diagnosis',
    ];

    //where this model belong to other model
    public function physical_examination()
    {
        return $this->belongsTo(PhysicalExamination::class);
    }
}
