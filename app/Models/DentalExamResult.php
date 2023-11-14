<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalExamResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'dental_exam_id',
        'oral_hygiene',
        'gingival_color',
        'consistency_of_the_gingiva',
        'oral_prophylaxis',
        'oral_prophylaxis_result',
        'restoration',
        'extraction',
        'prosthodontic_restoration',
        'prosthodontic_restoration_result',
        'orthodontist',
        'orthodontist_result',
    ];

    //where this model belong to other model
    public function dental_exam(){
        return $this->belongsTo(DentalExam::class);
    }

    //how many relationship does this model have with other models
    public function restoration_respond()
    {
        return $this->hasOne(Restoration::class);
    }
    public function extraction_respond()
    {
        return $this->hasOne(Extraction::class);
    }
}
