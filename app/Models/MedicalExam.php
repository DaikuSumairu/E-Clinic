<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'date_created',
        'date_updated',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_created' => 'date:m-d-Y',
        'date_updated' => 'date:m-d-Y',
    ];

    //where this model belong to other model
    public function record(){
        return $this->belongsTo(Record::class);
    }

    //how many relationship does this model have with other models
    public function past_medical_history()
    {
        return $this->hasOne(PastMedicalHistory::class);
    }
    public function family_history()
    {
        return $this->hasOne(FamilyHistory::class);
    }
    public function personal_social()
    {
        return $this->hasOne(PersonalSocial::class);
    }
    public function ob_gyne_review()
    {
        return $this->hasOne(OBGyneReview::class);
    }
    public function physical_examination()
    {
        return $this->hasOne(PhysicalExamination::class);
    }
}
