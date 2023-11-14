<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restoration extends Model
{
    use HasFactory;
    protected $fillable = [
        'dental_exam_result_id',
        'r_top_left_one',
        'r_top_left_two',
        'r_top_left_three',
        'r_top_left_four',
        'r_top_left_five',
        'r_top_left_six',
        'r_top_left_seven',
        'r_top_left_eight',
        'r_top_right_one',
        'r_top_right_two',
        'r_top_right_three',
        'r_top_right_four',
        'r_top_right_five',
        'r_top_right_six',
        'r_top_right_seven',
        'r_top_right_eight',
        'r_bot_left_one',
        'r_bot_left_two',
        'r_bot_left_three',
        'r_bot_left_four',
        'r_bot_left_five',
        'r_bot_left_six',
        'r_bot_left_seven',
        'r_bot_left_eight',
        'r_bot_right_one',
        'r_bot_right_two',
        'r_bot_right_three',
        'r_bot_right_four',
        'r_bot_right_five',
        'r_bot_right_six',
        'r_bot_right_seven',
        'r_bot_right_eight',
    ];

    //where this model belong to other model
    public function dental_exam_result(){
        return $this->belongsTo(DentalExamResult::class);
    }
}
