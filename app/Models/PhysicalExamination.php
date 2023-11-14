<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_exam_id',
        'height',
        'weight',
        'top_bp',
        'bot_bp',
        'pulse',
        'respiratory_rate',
        'bmi',
        'pe_general_appearance',
        'pe_skin',
        'pe_head_scalp',
        'pe_eyes',
        'pe_corrected',
        'pe_pupils',
        'pe_ear_eardrums',
        'pe_nose_sinuses',
        'pe_mouth_throat',
        'pe_neck_thyroid',
        'pe_chest_breast_axilla',
        'pe_heart_cardiovascular',
        'pe_lungs_respiratory',
        'pe_abdomen',
        'pe_back_flanks',
        'pe_anus_rectum',
        'pe_genito_urinary_system',
        'pe_inguinal_genitals',
        'pe_musculo_skeletal',
        'pe_extremities',
        'pe_reflexes',
        'pe_neurological',
    ];

    //where this model belong to other model
    public function medical_exam(){
        return $this->belongsTo(MedicalExam::class);
    }

    //how many relationship does this model have with other models
    public function pe_finding()
    {
        return $this->hasOne(PhysicalExaminationFinding::class);
    }
}
