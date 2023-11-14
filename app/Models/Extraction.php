<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraction extends Model
{
    use HasFactory;
    protected $fillable = [
        'dental_exam_result_id',
        'e_top_left_one',
        'e_top_left_two',
        'e_top_left_three',
        'e_top_left_four',
        'e_top_left_five',
        'e_top_left_six',
        'e_top_left_seven',
        'e_top_left_eight',
        'e_top_right_one',
        'e_top_right_two',
        'e_top_right_three',
        'e_top_right_four',
        'e_top_right_five',
        'e_top_right_six',
        'e_top_right_seven',
        'e_top_right_eight',
        'e_bot_left_one',
        'e_bot_left_two',
        'e_bot_left_three',
        'e_bot_left_four',
        'e_bot_left_five',
        'e_bot_left_six',
        'e_bot_left_seven',
        'e_bot_left_eight',
        'e_bot_right_one',
        'e_bot_right_two',
        'e_bot_right_three',
        'e_bot_right_four',
        'e_bot_right_five',
        'e_bot_right_six',
        'e_bot_right_seven',
        'e_bot_right_eight',
    ];

    //where this model belong to other model
    public function dental_exam_result(){
        return $this->belongsTo(DentalExamResult::class);
    }
}
