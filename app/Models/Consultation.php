<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'date_created',
        'date_updated',
        'date_finished',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_created' => 'date:m-d-Y',
        'date_updated' => 'date:m-d-Y',
        'date_finished' => 'date:m-d-Y',
    ];

    //where this model belong to other model
    public function record(){
        return $this->belongsTo(Record::class);
    }

    //how many relationship does this model have with other models
    public function consultation_response()
    {
        return $this->hasOne(ConsultationResponse::class);
    }
}
