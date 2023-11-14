<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\DentalExam;
use App\Models\DentalExamResult;
use App\Models\Restoration;
use App\Models\Extraction;
use Illuminate\Http\Request;

class DentalExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function date(Request $request, Record $recordId)
    {
        $responseData = [
            'den_output' => '',
            'first_output' => '',
            'second_output' => '',
            'third_output' => '',
            'fourth_output' => '',
            'fifth_output' => '',
            'sixth_output' => '',
            'seventh_output' => '',
            'eighth_output' => '',
        ];

        $dental_exams = DentalExam::where('id', $request->dental_exam_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereDate('date_created', $request->date_created)
                        ->orWhereNull('date_created');
                })
                ->orWhere(function ($query) use ($request) {
                    $query->whereDate('date_updated', $request->date_updated)
                        ->orWhereNull('date_updated');
                })
                ->orWhere('id', $request->id); 
            })
            ->get();

        foreach ($dental_exams as $dental_exam) {
            //Dental Exam Header
            if (auth()->user()->role->role == 'Dentist'){
                if ($dental_exam->date_updated && $dental_exam->date_created) {
                    $responseData['den_output'].='<span class="info">Original Copy</span>';
                }else{
                    $responseData['den_output'].='<a class="info btn btn-info ml-2" href="'. route('dentist.dentalExamEdit', $dental_exam->id ) .'">Update</a>';
                }
            } else {
                if ($dental_exam->date_updated && $dental_exam->date_created) {
                    $responseData['den_output'].='<span class="info">Original Copy</span>';
                } else if ($dental_exam->date_updated){
                    $responseData['den_output'].='<span class="info">Updated Version</span>';
                }
            }

            //First Output
            $responseData['first_output'].='<div class="col">
                    <span class="info h3"><strong>Oral Hygiene</strong></span>
                </div>
                <div class="col text-center">
                    <span class="info h3">'. $dental_exam->dental_exam_result->oral_hygiene .'</span>
                </div>';

            //Second Output
            $responseData['second_output'].='<div class="col">
                    <span class="info h3"><strong>Gingival Color</strong></span>
                </div>
                <div class="col text-center">
                    <span class="info h3">'. $dental_exam->dental_exam_result->gingival_color .'</span>
                </div>';

            //Third Output
            $responseData['third_output'].='<div class="col">
                    <span class="info h3"><strong>Consistency of the Gingiva</strong></span>
                </div>
                <div class="col text-center">
                    <span class="info h3">'. $dental_exam->dental_exam_result->consistency_of_the_gingiva .'</span>
                </div>';

            //Fourth Output
            $responseData['fourth_output'].='<div class="col">
                    <span class="info h3"><strong>Oral Prophylaxis</strong></span>
                </div>
                <div class="col '; if ($dental_exam->dental_exam_result->oral_prophylaxis === 'No') {$responseData['fourth_output'].='text-center';} $responseData['fourth_output'].='">';
                    if ($dental_exam->dental_exam_result->oral_prophylaxis === 'Yes') {
                        $responseData['fourth_output'].='<textarea class="form-control-plaintext" row="2" readonly>'. $dental_exam->dental_exam_result->oral_prophylaxis_result .'</textarea>';
                    } else {
                        $responseData['fourth_output'].='<span class="info h3">'. $dental_exam->dental_exam_result->oral_prophylaxis .'</span>';
                    }
                $responseData['fourth_output'].='</div>';

            //Fifth Output
            $responseData['fifth_output'].='<div class="col py-2">
                    <span class="info h3"><strong>Restoration of:</strong></span>
                </div>
                <div class="col '; if ($dental_exam->dental_exam_result->restoration === 'No') {$responseData['fifth_output'].='text-center';} $responseData['fifth_output'].='">';
                    if ($dental_exam->dental_exam_result->restoration === 'Yes') {
                        $responseData['fifth_output'].='<div class="row row-cols-2">
                            <!-- Top Left -->
                            <div class="col border-bottom border-right border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_one === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_two === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_three === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_four === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_five === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_six === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_seven === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_left_eight === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                            </div>
                            
                            <!-- Top Rigth -->
                            <div class="col border-bottom border-left border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_one === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_two === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_three === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_four === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_five === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_six === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_seven === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_top_right_eight === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                            </div>
                            
                            <!-- Bot Left -->
                            <div class="col border-top border-right border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_one === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_two === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_three === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_four === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_five === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_six === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_seven === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_eight === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                            </div>
                            
                            <!-- Bot Rigth -->
                            <div class="col border-top border-left border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_one === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_two === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_three === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_four === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_five === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_six === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_seven === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_eight === 'Yes'){$responseData['fifth_output'].='disabled';}$responseData['fifth_output'].='>
                            </div>
                        </div>';
                    } else {
                        $responseData['fifth_output'].='<span class="info h3">'. $dental_exam->dental_exam_result->restoration .'</span>';
                    }
                $responseData['fifth_output'].='</div>';

            //Sixth Output
            $responseData['sixth_output'].='<div class="col py-2">
                    <span class="info h3"><strong>Tooth Extraction of:</strong></span>
                </div>
                <div class="col '; if ($dental_exam->dental_exam_result->extraction === 'No') {$responseData['sixth_output'].='text-center';} $responseData['sixth_output'].='">';
                    if ($dental_exam->dental_exam_result->extraction === 'Yes') {
                        $responseData['sixth_output'].='<div class="row row-cols-2">
                            <!-- Top Left -->
                            <div class="col border-bottom border-right border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_one === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_two === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_three === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_four === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_five === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_six === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_seven === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_left_eight === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                            </div>
                            
                            <!-- Top Rigth -->
                            <div class="col border-bottom border-left border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_one === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_two === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_three === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_four === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_five === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_six === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_seven === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_top_right_eight === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                            </div>
                            
                            <!-- Bot Left -->
                            <div class="col border-top border-right border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_one === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_two === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_three === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_four === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_five === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_six === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_seven === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_eight === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                            </div>
                            
                            <!-- Bot Rigth -->
                            <div class="col border-top border-left border-dark border-3 text-center">
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_one === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_two === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_three === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_four === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_five === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_six === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_seven === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                                <input type="checkbox" class="mx-2" style="pointer-events: none;" '; if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_eight === 'Yes'){$responseData['sixth_output'].='disabled';}$responseData['sixth_output'].='>
                            </div>
                        </div>';
                    } else {
                        $responseData['sixth_output'].='<span class="info h3">'. $dental_exam->dental_exam_result->extraction .'</span>';
                    }
                $responseData['sixth_output'].='</div>';

            //Seventh Output
            $responseData['seventh_output'].='<div class="col">
                    <span class="info h3"><strong>Prosthodontic Restoration</strong></span>
                </div>
                <div class="col '; if ($dental_exam->dental_exam_result->prosthodontic_restoration === 'No') {$responseData['seventh_output'].='text-center';} $responseData['seventh_output'].='">';
                    if ($dental_exam->dental_exam_result->prosthodontic_restoration === 'Yes') {
                        $responseData['seventh_output'].='<textarea class="form-control-plaintext" row="2" readonly>'. $dental_exam->dental_exam_result->prosthodontic_restoration_result .'</textarea>';
                    } else {
                        $responseData['seventh_output'].='<span class="info h3">'. $dental_exam->dental_exam_result->prosthodontic_restoration .'</span>';
                    }
                $responseData['seventh_output'].='</div>';

            //Eighth Output
            $responseData['eighth_output'].='<div class="col">
                    <span class="info h3"><strong>See an Orthodontist</strong></span>
                </div>
                <div class="col '; if ($dental_exam->dental_exam_result->orthodontist === 'No') {$responseData['eighth_output'].='text-center';} $responseData['eighth_output'].='">';
                    if ($dental_exam->dental_exam_result->orthodontist === 'Yes') {
                        $responseData['eighth_output'].='<textarea class="form-control-plaintext" row="2" readonly>'. $dental_exam->dental_exam_result->orthodontist_result .'</textarea>';
                    } else {
                        $responseData['eighth_output'].='<span class="info h3">'. $dental_exam->dental_exam_result->orthodontist .'</span>';
                    }
                $responseData['eighth_output'].='</div>';
        }

        return response($responseData);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Record $record)
    {
        return view('dentist.record.dental-exam.record-de-create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Connect Medical Exam ID to a specific Record ID
        $recordID = $request->input('record_id');
        $dental_examData = $request->all();
        $dental_examData['record_id'] = $recordID;

        //Creating Medical Exam
        $dental_exam = DentalExam::create($dental_examData);

        //Connect Past Medical History ID to a specific Medical Exam ID
        $request->validate([
            'oral_hygiene' => 'in:Good,Fair,Poor',
            'gingival_color' => 'in:Pink,Pale,Bright Red',
            'consistency_of_the_gingiva' => 'in:Firm,Smooth,Enlarge',
            'oral_prophylaxis' => 'string',
            'oral_prophylaxis_result' => 'max:250',
            'restoration' => 'string',
            'extraction' => 'string',
            'prosthodontic_restoration' => 'string',
            'prosthodontic_restoration_result' => 'max:250',
            'orthodontist' => 'string',
            'orthodontist_result' => 'max:250',
        ]);

        $dental_examID = $dental_exam->id;
        $dental_exam_resultData = $request->all();
        $dental_exam_resultData['dental_exam_id'] = $dental_examID;

        //Creating Past Medical History
        $dental_exam_result = DentalExamResult::create($dental_exam_resultData);

        //Connect Past Medical History Findings ID to a specific Past Medical History ID
        $request->validate([
            'r_top_left_one' => 'string',
            'r_top_left_two' => 'string',
            'r_top_left_three' => 'string',
            'r_top_left_four' => 'string',
            'r_top_left_five' => 'string',
            'r_top_left_six' => 'string',
            'r_top_left_seven' => 'string',
            'r_top_left_eight' => 'string',
            'r_top_right_one' => 'string',
            'r_top_right_two' => 'string',
            'r_top_right_three' => 'string',
            'r_top_right_four' => 'string',
            'r_top_right_five' => 'string',
            'r_top_right_six' => 'string',
            'r_top_right_seven' => 'string',
            'r_top_right_eight' => 'string',
            'r_bot_left_one' => 'string',
            'r_bot_left_two' => 'string',
            'r_bot_left_three' => 'string',
            'r_bot_left_four' => 'string',
            'r_bot_left_five' => 'string',
            'r_bot_left_six' => 'string',
            'r_bot_left_seven' => 'string',
            'r_bot_left_eight' => 'string',
            'r_bot_right_one' => 'string',
            'r_bot_right_two' => 'string',
            'r_bot_right_three' => 'string',
            'r_bot_right_four' => 'string',
            'r_bot_right_five' => 'string',
            'r_bot_right_six' => 'string',
            'r_bot_right_seven' => 'string',
            'r_bot_right_eight' => 'string',
        ]);

        $dental_exam_resultID = $dental_exam_result->id;
        $restorationData  = $request->all();
        $restorationData['dental_exam_result_id'] = $dental_exam_resultID;

        Restoration::create($restorationData);

        //Connect Family History ID to a specific Medical Exam ID
        $request->validate([
            'e_top_left_one' => 'string',
            'e_top_left_two' => 'string',
            'e_top_left_three' => 'string',
            'e_top_left_four' => 'string',
            'e_top_left_five' => 'string',
            'e_top_left_six' => 'string',
            'e_top_left_seven' => 'string',
            'e_top_left_eight' => 'string',
            'e_top_right_one' => 'string',
            'e_top_right_two' => 'string',
            'e_top_right_three' => 'string',
            'e_top_right_four' => 'string',
            'e_top_right_five' => 'string',
            'e_top_right_six' => 'string',
            'e_top_right_seven' => 'string',
            'e_top_right_eight' => 'string',
            'e_bot_left_one' => 'string',
            'e_bot_left_two' => 'string',
            'e_bot_left_three' => 'string',
            'e_bot_left_four' => 'string',
            'e_bot_left_five' => 'string',
            'e_bot_left_six' => 'string',
            'e_bot_left_seven' => 'string',
            'e_bot_left_eight' => 'string',
            'e_bot_right_one' => 'string',
            'e_bot_right_two' => 'string',
            'e_bot_right_three' => 'string',
            'e_bot_right_four' => 'string',
            'e_bot_right_five' => 'string',
            'e_bot_right_six' => 'string',
            'e_bot_right_seven' => 'string',
            'e_bot_right_eight' => 'string',
        ]);

        $extractionData = $request->all();
        $extractionData['dental_exam_result_id'] = $dental_exam_resultID;

        //Create Family History
        Extraction::create($extractionData);

        return redirect()->route('dentist.recordShow', ['record' => $recordID])->with('success', 'Dental exam created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DentalExam $dental_exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DentalExam $dental_exam)
    {
        return view('dentist.record.dental-exam.record-de-edit', compact('dental_exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DentalExam $dental_exam)
    {
        if ($dental_exam->date_updated === null) {
            $dental_exam->update(['date_created' => $dental_exam->date_created,
                                    'date_updated' => $dental_exam->date_created]);
            $dental_examData = ['date_updated' => $request->input('date_updated')];
            $dental_examData['record_id'] = $dental_exam->record->id;

            //Creating Medical Exam
            $dental_exam = DentalExam::create($dental_examData);

            //Connect Past Medical History ID to a specific Medical Exam ID
            $request->validate([
                'oral_hygiene' => 'in:Good,Fair,Poor',
                'gingival_color' => 'in:Pink,Pale,Bright Red',
                'consistency_of_the_gingiva' => 'in:Firm,Smooth,Enlarge',
                'oral_prophylaxis' => 'string',
                'oral_prophylaxis_result' => 'max:250',
                'restoration' => 'string',
                'extraction' => 'string',
                'prosthodontic_restoration' => 'string',
                'prosthodontic_restoration_result' => 'max:250',
                'orthodontist' => 'string',
                'orthodontist_result' => 'max:250',
            ]);

            $dental_examID = $dental_exam->id;
            $dental_exam_resultData = $request->all();
            $dental_exam_resultData['dental_exam_id'] = $dental_examID;

            //Creating Past Medical History
            $dental_exam_result = DentalExamResult::create($dental_exam_resultData);

            //Connect Past Medical History Findings ID to a specific Past Medical History ID
            $request->validate([
                'r_top_left_one' => 'string',
                'r_top_left_two' => 'string',
                'r_top_left_three' => 'string',
                'r_top_left_four' => 'string',
                'r_top_left_five' => 'string',
                'r_top_left_six' => 'string',
                'r_top_left_seven' => 'string',
                'r_top_left_eight' => 'string',
                'r_top_right_one' => 'string',
                'r_top_right_two' => 'string',
                'r_top_right_three' => 'string',
                'r_top_right_four' => 'string',
                'r_top_right_five' => 'string',
                'r_top_right_six' => 'string',
                'r_top_right_seven' => 'string',
                'r_top_right_eight' => 'string',
                'r_bot_left_one' => 'string',
                'r_bot_left_two' => 'string',
                'r_bot_left_three' => 'string',
                'r_bot_left_four' => 'string',
                'r_bot_left_five' => 'string',
                'r_bot_left_six' => 'string',
                'r_bot_left_seven' => 'string',
                'r_bot_left_eight' => 'string',
                'r_bot_right_one' => 'string',
                'r_bot_right_two' => 'string',
                'r_bot_right_three' => 'string',
                'r_bot_right_four' => 'string',
                'r_bot_right_five' => 'string',
                'r_bot_right_six' => 'string',
                'r_bot_right_seven' => 'string',
                'r_bot_right_eight' => 'string',
            ]);

            $dental_exam_resultID = $dental_exam_result->id;
            $restorationData  = $request->all();
            $restorationData['dental_exam_result_id'] = $dental_exam_resultID;

            Restoration::create($restorationData);

            //Connect Family History ID to a specific Medical Exam ID
            $request->validate([
                'e_top_left_one' => 'string',
                'e_top_left_two' => 'string',
                'e_top_left_three' => 'string',
                'e_top_left_four' => 'string',
                'e_top_left_five' => 'string',
                'e_top_left_six' => 'string',
                'e_top_left_seven' => 'string',
                'e_top_left_eight' => 'string',
                'e_top_right_one' => 'string',
                'e_top_right_two' => 'string',
                'e_top_right_three' => 'string',
                'e_top_right_four' => 'string',
                'e_top_right_five' => 'string',
                'e_top_right_six' => 'string',
                'e_top_right_seven' => 'string',
                'e_top_right_eight' => 'string',
                'e_bot_left_one' => 'string',
                'e_bot_left_two' => 'string',
                'e_bot_left_three' => 'string',
                'e_bot_left_four' => 'string',
                'e_bot_left_five' => 'string',
                'e_bot_left_six' => 'string',
                'e_bot_left_seven' => 'string',
                'e_bot_left_eight' => 'string',
                'e_bot_right_one' => 'string',
                'e_bot_right_two' => 'string',
                'e_bot_right_three' => 'string',
                'e_bot_right_four' => 'string',
                'e_bot_right_five' => 'string',
                'e_bot_right_six' => 'string',
                'e_bot_right_seven' => 'string',
                'e_bot_right_eight' => 'string',
            ]);

            $extractionData = $request->all();
            $extractionData['dental_exam_result_id'] = $dental_exam_resultID;

            //Create Family History
            Extraction::create($extractionData);
        } else {

            $dental_exam->update($request->all()); 

            //Connect Past Medical History ID to a specific Medical Exam ID
            $request->validate([
                'oral_hygiene' => 'in:Good,Fair,Poor',
                'gingival_color' => 'in:Pink,Pale,Bright Red',
                'consistency_of_the_gingiva' => 'in:Firm,Smooth,Enlarge',
                'oral_prophylaxis' => 'string',
                'oral_prophylaxis_result' => 'max:250',
                'restoration' => 'string',
                'extraction' => 'string',
                'prosthodontic_restoration' => 'string',
                'prosthodontic_restoration_result' => 'max:250',
                'orthodontist' => 'string',
                'orthodontist_result' => 'max:250',
            ]);

            //Creating Past Medical History
            $dental_exam->dental_exam_result->update($request->all());

            //Connect Past Medical History Findings ID to a specific Past Medical History ID
            $request->validate([
                'r_top_left_one' => 'string',
                'r_top_left_two' => 'string',
                'r_top_left_three' => 'string',
                'r_top_left_four' => 'string',
                'r_top_left_five' => 'string',
                'r_top_left_six' => 'string',
                'r_top_left_seven' => 'string',
                'r_top_left_eight' => 'string',
                'r_top_right_one' => 'string',
                'r_top_right_two' => 'string',
                'r_top_right_three' => 'string',
                'r_top_right_four' => 'string',
                'r_top_right_five' => 'string',
                'r_top_right_six' => 'string',
                'r_top_right_seven' => 'string',
                'r_top_right_eight' => 'string',
                'r_bot_left_one' => 'string',
                'r_bot_left_two' => 'string',
                'r_bot_left_three' => 'string',
                'r_bot_left_four' => 'string',
                'r_bot_left_five' => 'string',
                'r_bot_left_six' => 'string',
                'r_bot_left_seven' => 'string',
                'r_bot_left_eight' => 'string',
                'r_bot_right_one' => 'string',
                'r_bot_right_two' => 'string',
                'r_bot_right_three' => 'string',
                'r_bot_right_four' => 'string',
                'r_bot_right_five' => 'string',
                'r_bot_right_six' => 'string',
                'r_bot_right_seven' => 'string',
                'r_bot_right_eight' => 'string',
            ]);

            $dental_exam->dental_exam_result->restoration_respond->update($request->all());

            //Connect Family History ID to a specific Medical Exam ID
            $request->validate([
                'e_top_left_one' => 'string',
                'e_top_left_two' => 'string',
                'e_top_left_three' => 'string',
                'e_top_left_four' => 'string',
                'e_top_left_five' => 'string',
                'e_top_left_six' => 'string',
                'e_top_left_seven' => 'string',
                'e_top_left_eight' => 'string',
                'e_top_right_one' => 'string',
                'e_top_right_two' => 'string',
                'e_top_right_three' => 'string',
                'e_top_right_four' => 'string',
                'e_top_right_five' => 'string',
                'e_top_right_six' => 'string',
                'e_top_right_seven' => 'string',
                'e_top_right_eight' => 'string',
                'e_bot_left_one' => 'string',
                'e_bot_left_two' => 'string',
                'e_bot_left_three' => 'string',
                'e_bot_left_four' => 'string',
                'e_bot_left_five' => 'string',
                'e_bot_left_six' => 'string',
                'e_bot_left_seven' => 'string',
                'e_bot_left_eight' => 'string',
                'e_bot_right_one' => 'string',
                'e_bot_right_two' => 'string',
                'e_bot_right_three' => 'string',
                'e_bot_right_four' => 'string',
                'e_bot_right_five' => 'string',
                'e_bot_right_six' => 'string',
                'e_bot_right_seven' => 'string',
                'e_bot_right_eight' => 'string',
            ]);

            $dental_exam->dental_exam_result->extraction_respond->update($request->all());
        }

        return redirect()->route('dentist.recordShow', ['record' => $dental_exam->record->id])->with('success', 'Dental exam created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DentalExam $dental_exam)
    {
        //
    }
}
