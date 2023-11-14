<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'birth_date',
        'age',
        'sex',
        'civil_status',
        'address',
        'street',
        'city',
        'province',
        'zip',
        'mobile_number',
        'contact_person',
        'contact_person_number',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date:m-d-Y',
    ];

    //where this model belong to other model
    public function user(){
        return $this->belongsTo(User::class);
    }

    //how many relationship does this model have with other models
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function medical_exams()
    {
        return $this->hasMany(MedicalExam::class);
    }

    public function dental_exams()
    {
        return $this->hasMany(DentalExam::class);
    }
}
