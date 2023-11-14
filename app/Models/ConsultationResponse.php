<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'complaint',
        'pulse',
        'oxygen',
        'respiratory_rate',
        'top_bp',
        'bot_bp',
        'temperature',
        'treatment',
        'remarks',
    ];

    //where this model belong to other model
    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }
}
