@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Dental Exam')

<!-- Content Header -->
@section('content_header')
    <h1>Updating Dental Exam for {{ $dental_exam->record->user->name }}</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Go back from the last page -->
<a class="btn btn-danger mb-2" href="{{ route('dentist.recordShow', $dental_exam->record->id) }}">Go Back</a>

<!-- Body -->
<div class="container-xxl mb-2 record-customize-create-container-height border px-3">
    <form method="POST" action="{{ route('dentist.dentalExamUpdate', $dental_exam->id) }}" onsubmit="return confirm('Are you sure you want to submit this dental exam?');">
        @csrf
        @method('PUT')

        <!-- Date -->
        <div class="row py-2 my-1">
            <div class="col text-right pt-2">
                <i class="far fa-calendar"></i>
            </div>
            <div class="col-sm-2">
                <input type="date" class="form-control-plaintext" id="current_date" name="date_updated" readonly>
            </div>
        </div>

        <!-- First Row -->
        <div class="row py-2 my-1">
            <div class="col">
                <span class="info h3"><strong>Oral Hygiene</strong></span>
            </div>
            <div class="col">
                <select class="form-control" name="oral_hygiene">
                    <option value="Good" @if($dental_exam->dental_exam_result->oral_hygiene === 'Good') selected @endif>Good</option>
                    <option value="Fair" @if($dental_exam->dental_exam_result->oral_hygiene === 'Fair') selected @endif>Fair</option>
                    <option value="Poor" @if($dental_exam->dental_exam_result->oral_hygiene === 'Poor') selected @endif>Poor</option>
                </select>
            </div>
        </div>

        <!-- Second Row -->
        <div class="row py-2 my-1">
            <div class="col">
                <span class="info h3"><strong>Gingival Color</strong></span>
            </div>
            <div class="col">
                <select class="form-control" name="gingival_color">
                    <option value="Pink" @if($dental_exam->dental_exam_result->gingival_color === 'Pink') selected @endif>Pink</option>
                    <option value="Pale" @if($dental_exam->dental_exam_result->gingival_color === 'Pale') selected @endif>Pale</option>
                    <option value="Bright Red" @if($dental_exam->dental_exam_result->gingival_color === 'Bright Red') selected @endif>Bright Red</option>
                </select>
            </div>
        </div>

        <!-- Third Row -->
        <div class="row py-2 my-1">
            <div class="col">
                <span class="info h3"><strong>Consistency of the Gingiva</strong></span>
            </div>
            <div class="col">
                <select class="form-control" name="consistency_of_the_gingiva">
                    <option value="Firm" @if($dental_exam->dental_exam_result->consistency_of_the_gingiva === 'Firm') selected @endif>Firm</option>
                    <option value="Smooth" @if($dental_exam->dental_exam_result->consistency_of_the_gingiva === 'Smooth') selected @endif>Smooth</option>
                    <option value="Enlarge" @if($dental_exam->dental_exam_result->consistency_of_the_gingiva === 'Enlarge') selected @endif>Enlarge</option>
                </select>
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="row py-2 my-1">
            <div class="col">
                @if($dental_exam->dental_exam_result->oral_prophylaxis === 'Yes')
                <input type="checkbox" id="oral_prophylaxis" class="customize-checkbox" name="oral_prophylaxis" value="Yes" onchange="toggleCheck(this, 'oral_prophylaxis')" checked>
                <input type="hidden" id="self_oral_prophylaxis" name="oral_prophylaxis" value="No" disabled>
                @else
                <input type="checkbox" id="oral_prophylaxis" class="customize-checkbox" name="oral_prophylaxis" value="Yes" onchange="toggleCheck(this, 'oral_prophylaxis')">
                <input type="hidden" id="self_oral_prophylaxis" name="oral_prophylaxis" value="No">
                @endif
                <span class="info h3"><strong>Oral Prophylaxis</strong></span>
            </div>
            <div class="col">
                @if($dental_exam->dental_exam_result->oral_prophylaxis === 'Yes')
                <textarea class="form-control" id="oral_prophylaxis_result" name="oral_prophylaxis_result" row="2">{{ $dental_exam->dental_exam_result->oral_prophylaxis_result }}</textarea>
                @else
                <textarea class="form-control" id="oral_prophylaxis_result" name="oral_prophylaxis_result" row="2" disabled>Not Applicable</textarea>
                @endif
            </div>
        </div>

        <!-- Fifth Row -->
        <div class="row py-2 my-1">
            <div class="col py-2">
                @if($dental_exam->dental_exam_result->restoration === 'Yes')
                <input type="checkbox" id="restoration" class="customize-checkbox" name="restoration" value="Yes" onchange="toggleCheck(this, 'restoration')" checked>
                <input type="hidden" id="self_restoration" name="restoration" value="No" disabled>
                @else
                <input type="checkbox" id="restoration" class="customize-checkbox" name="restoration" value="Yes" onchange="toggleCheck(this, 'restoration')">
                <input type="hidden" id="self_restoration" name="restoration" value="No">
                @endif
                <span class="info h3"><strong>Restoration of:</strong></span>
            </div>
            <div class="col">
                @if($dental_exam->dental_exam_result->restoration === 'Yes')
                <div class="row row-cols-2">
                    <!-- Top Left -->
                    <div class="col border-bottom border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_one')" id="r_top_left_one" name="r_top_left_one" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_one" name="r_top_left_one" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_two')" id="r_top_left_two" name="r_top_left_two" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_two" name="r_top_left_two" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_three')" id="r_top_left_three" name="r_top_left_three" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_three" name="r_top_left_three" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_four')" id="r_top_left_four" name="r_top_left_four" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_four" name="r_top_left_four" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_five')" id="r_top_left_five" name="r_top_left_five" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_five" name="r_top_left_five" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_six')" id="r_top_left_six" name="r_top_left_six" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_six" name="r_top_left_six" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_seven')" id="r_top_left_seven" name="r_top_left_seven" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_seven" name="r_top_left_seven" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_eight')" id="r_top_left_eight" name="r_top_left_eight" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_eight" name="r_top_left_eight" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_left_eight === 'Yes') disabled @endif>
                    </div>
                    
                    <!-- Top Rigth -->
                    <div class="col border-bottom border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_one')" id="r_top_right_one" name="r_top_right_one" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_one" name="r_top_right_one" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_two')" id="r_top_right_two" name="r_top_right_two" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_two" name="r_top_right_two" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_three')" id="r_top_right_three" name="r_top_right_three" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_three" name="r_top_right_three" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_four')" id="r_top_right_four" name="r_top_right_four" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_four" name="r_top_right_four" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_five')" id="r_top_right_five" name="r_top_right_five" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_five" name="r_top_right_five" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_six')" id="r_top_right_six" name="r_top_right_six" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_six" name="r_top_right_six" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_seven')" id="r_top_right_seven" name="r_top_right_seven" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_seven" name="r_top_right_seven" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_eight')" id="r_top_right_eight" name="r_top_right_eight" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_eight" name="r_top_right_eight" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_top_right_eight === 'Yes') disabled @endif>
                    </div>
                    
                    <!-- Bot Left -->
                    <div class="col border-top border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_one')" id="r_bot_left_one" name="r_bot_left_one" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_one" name="r_bot_left_one" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_two')" id="r_bot_left_two" name="r_bot_left_two" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_two" name="r_bot_left_two" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_three')" id="r_bot_left_three" name="r_bot_left_three" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_three" name="r_bot_left_three" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_four')" id="r_bot_left_four" name="r_bot_left_four" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_four" name="r_bot_left_four" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_five')" id="r_bot_left_five" name="r_bot_left_five" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_five" name="r_bot_left_five" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_six')" id="r_bot_left_six" name="r_bot_left_six" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_six" name="r_bot_left_six" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_seven')" id="r_bot_left_seven" name="r_bot_left_seven" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_seven" name="r_bot_left_seven" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_eight')" id="r_bot_left_eight" name="r_bot_left_eight" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_eight" name="r_bot_left_eight" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_left_eight === 'Yes') disabled @endif>
                    </div>
                    
                    <!-- Bot Rigth -->
                    <div class="col border-top border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_one')" id="r_bot_right_one" name="r_bot_right_one" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_one" name="r_bot_right_one" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_two')" id="r_bot_right_two" name="r_bot_right_two" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_two" name="r_bot_right_two" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_three')" id="r_bot_right_three" name="r_bot_right_three" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_three" name="r_bot_right_three" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_four')" id="r_bot_right_four" name="r_bot_right_four" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_four" name="r_bot_right_four" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_five')" id="r_bot_right_five" name="r_bot_right_five" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_five" name="r_bot_right_five" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_six')" id="r_bot_right_six" name="r_bot_right_six" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_six" name="r_bot_right_six" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_seven')" id="r_bot_right_seven" name="r_bot_right_seven" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_seven" name="r_bot_right_seven" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_eight')" id="r_bot_right_eight" name="r_bot_right_eight" value="Yes" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_eight" name="r_bot_right_eight" value="No" @if($dental_exam->dental_exam_result->restoration_respond->r_bot_right_eight === 'Yes') disabled @endif>
                    </div>
                </div>
                @else
                <div class="row row-cols-2">
                    <!-- Top Left -->
                    <div class="col border-bottom border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_one')" id="r_top_left_one" name="r_top_left_one" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_one" name="r_top_left_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_two')" id="r_top_left_two" name="r_top_left_two" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_two" name="r_top_left_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_three')" id="r_top_left_three" name="r_top_left_three" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_three" name="r_top_left_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_four')" id="r_top_left_four" name="r_top_left_four" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_four" name="r_top_left_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_five')" id="r_top_left_five" name="r_top_left_five" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_five" name="r_top_left_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_six')" id="r_top_left_six" name="r_top_left_six" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_six" name="r_top_left_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_seven')" id="r_top_left_seven" name="r_top_left_seven" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_seven" name="r_top_left_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_left_eight')" id="r_top_left_eight" name="r_top_left_eight" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_left_eight" name="r_top_left_eight" value="No">
                    </div>
                    
                    <!-- Top Rigth -->
                    <div class="col border-bottom border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_one')" id="r_top_right_one" name="r_top_right_one" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_one" name="r_top_right_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_two')" id="r_top_right_two" name="r_top_right_two" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_two" name="r_top_right_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_three')" id="r_top_right_three" name="r_top_right_three" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_three" name="r_top_right_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_four')" id="r_top_right_four" name="r_top_right_four" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_four" name="r_top_right_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_five')" id="r_top_right_five" name="r_top_right_five" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_five" name="r_top_right_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_six')" id="r_top_right_six" name="r_top_right_six" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_six" name="r_top_right_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_seven')" id="r_top_right_seven" name="r_top_right_seven" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_seven" name="r_top_right_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_top_right_eight')" id="r_top_right_eight" name="r_top_right_eight" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_top_right_eight" name="r_top_right_eight" value="No">
                    </div>
                    
                    <!-- Bot Left -->
                    <div class="col border-top border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_one')" id="r_bot_left_one" name="r_bot_left_one" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_one" name="r_bot_left_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_two')" id="r_bot_left_two" name="r_bot_left_two" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_two" name="r_bot_left_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_three')" id="r_bot_left_three" name="r_bot_left_three" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_three" name="r_bot_left_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_four')" id="r_bot_left_four" name="r_bot_left_four" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_four" name="r_bot_left_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_five')" id="r_bot_left_five" name="r_bot_left_five" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_five" name="r_bot_left_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_six')" id="r_bot_left_six" name="r_bot_left_six" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_six" name="r_bot_left_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_seven')" id="r_bot_left_seven" name="r_bot_left_seven" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_seven" name="r_bot_left_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_left_eight')" id="r_bot_left_eight" name="r_bot_left_eight" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_left_eight" name="r_bot_left_eight" value="No">
                    </div>
                    
                    <!-- Bot Rigth -->
                    <div class="col border-top border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_one')" id="r_bot_right_one" name="r_bot_right_one" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_one" name="r_bot_right_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_two')" id="r_bot_right_two" name="r_bot_right_two" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_two" name="r_bot_right_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_three')" id="r_bot_right_three" name="r_bot_right_three" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_three" name="r_bot_right_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_four')" id="r_bot_right_four" name="r_bot_right_four" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_four" name="r_bot_right_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_five')" id="r_bot_right_five" name="r_bot_right_five" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_five" name="r_bot_right_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_six')" id="r_bot_right_six" name="r_bot_right_six" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_six" name="r_bot_right_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_seven')" id="r_bot_right_seven" name="r_bot_right_seven" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_seven" name="r_bot_right_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('r_bot_right_eight')" id="r_bot_right_eight" name="r_bot_right_eight" value="Yes" disabled>
                        <input type="hidden" class="all-restoration" id="mini_r_bot_right_eight" name="r_bot_right_eight" value="No">
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Sixth Row -->
        <div class="row py-2 my-1">
            <div class="col py-2">
                @if($dental_exam->dental_exam_result->extraction === 'Yes')
                <input type="checkbox" id="extraction" class="customize-checkbox" name="extraction" value="Yes" onchange="toggleCheck(this, 'extraction')" checked>
                <input type="hidden" id="self_extraction" name="extraction" value="No" disabled>
                @else
                <input type="checkbox" id="extraction" class="customize-checkbox" name="extraction" value="Yes" onchange="toggleCheck(this, 'extraction')">
                <input type="hidden" id="self_extraction" name="extraction" value="No">
                @endif
                <span class="info h3"><strong>Tooth Extraction of:</strong></span>
            </div>
            <div class="col">
                @if($dental_exam->dental_exam_result->extraction === 'Yes')
                <div class="row row-cols-2">
                    <!-- Top Left -->
                    <div class="col border-bottom border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_one')" id="e_top_left_one" name="e_top_left_one" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_one" name="e_top_left_one" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_two')" id="e_top_left_two" name="e_top_left_two" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_two" name="e_top_left_two" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_three')" id="e_top_left_three" name="e_top_left_three" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_three" name="e_top_left_three" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_four')" id="e_top_left_four" name="e_top_left_four" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_four" name="e_top_left_four" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_five')" id="e_top_left_five" name="e_top_left_five" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_five" name="e_top_left_five" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_six')" id="e_top_left_six" name="e_top_left_six" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_six" name="e_top_left_six" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_seven')" id="e_top_left_seven" name="e_top_left_seven" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_seven" name="e_top_left_seven" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_eight')" id="e_top_left_eight" name="e_top_left_eight" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_eight" name="e_top_left_eight" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_left_eight === 'Yes') disabled @endif>
                    </div>
                    
                    <!-- Top Rigth -->
                    <div class="col border-bottom border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_one')" id="e_top_right_one" name="e_top_right_one" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_one" name="e_top_right_one" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_two')" id="e_top_right_two" name="e_top_right_two" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_two" name="e_top_right_two" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_three')" id="e_top_right_three" name="e_top_right_three" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_three" name="e_top_right_three" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_four')" id="e_top_right_four" name="e_top_right_four" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_four" name="e_top_right_four" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_five')" id="e_top_right_five" name="e_top_right_five" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_five" name="e_top_right_five" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_six')" id="e_top_right_six" name="e_top_right_six" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_six" name="e_top_right_six" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_seven')" id="e_top_right_seven" name="e_top_right_seven" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_seven" name="e_top_right_seven" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_eight')" id="e_top_right_eight" name="e_top_right_eight" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_eight" name="e_top_right_eight" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_top_right_eight === 'Yes') disabled @endif>
                    </div>
                    
                    <!-- Bot Left -->
                    <div class="col border-top border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_one')" id="e_bot_left_one" name="e_bot_left_one" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_one" name="e_bot_left_one" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_two')" id="e_bot_left_two" name="e_bot_left_two" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_two" name="e_bot_left_two" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_three')" id="e_bot_left_three" name="e_bot_left_three" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_three" name="e_bot_left_three" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_four')" id="e_bot_left_four" name="e_bot_left_four" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_four" name="e_bot_left_four" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_five')" id="e_bot_left_five" name="e_bot_left_five" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_five" name="e_bot_left_five" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_six')" id="e_bot_left_six" name="e_bot_left_six" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_six" name="e_bot_left_six" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_seven')" id="e_bot_left_seven" name="e_bot_left_seven" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_seven" name="e_bot_left_seven" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_eight')" id="e_bot_left_eight" name="e_bot_left_eight" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_eight" name="e_bot_left_eight" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_left_eight === 'Yes') disabled @endif>
                    </div>
                    
                    <!-- Bot Rigth -->
                    <div class="col border-top border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_one')" id="e_bot_right_one" name="e_bot_right_one" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_one === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_one" name="e_bot_right_one" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_one === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_two')" id="e_bot_right_two" name="e_bot_right_two" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_two === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_two" name="e_bot_right_two" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_two === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_three')" id="e_bot_right_three" name="e_bot_right_three" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_three === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_three" name="e_bot_right_three" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_three === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_four')" id="e_bot_right_four" name="e_bot_right_four" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_four === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_four" name="e_bot_right_four" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_four === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_five')" id="e_bot_right_five" name="e_bot_right_five" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_five === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_five" name="e_bot_right_five" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_five === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_six')" id="e_bot_right_six" name="e_bot_right_six" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_six === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_six" name="e_bot_right_six" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_six === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_seven')" id="e_bot_right_seven" name="e_bot_right_seven" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_seven === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_seven" name="e_bot_right_seven" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_seven === 'Yes') disabled @endif>
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_eight')" id="e_bot_right_eight" name="e_bot_right_eight" value="Yes" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_eight === 'Yes') checked @endif>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_eight" name="e_bot_right_eight" value="No" @if($dental_exam->dental_exam_result->extraction_respond->e_bot_right_eight === 'Yes') disabled @endif>
                    </div>
                </div>
                @else
                <div class="row row-cols-2">
                    <!-- Top Left -->
                    <div class="col border-bottom border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_one')" id="e_top_left_one" name="e_top_left_one" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_one" name="e_top_left_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_two')" id="e_top_left_two" name="e_top_left_two" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_two" name="e_top_left_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_three')" id="e_top_left_three" name="e_top_left_three" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_three" name="e_top_left_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_four')" id="e_top_left_four" name="e_top_left_four" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_four" name="e_top_left_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_five')" id="e_top_left_five" name="e_top_left_five" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_five" name="e_top_left_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_six')" id="e_top_left_six" name="e_top_left_six" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_six" name="e_top_left_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_seven')" id="e_top_left_seven" name="e_top_left_seven" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_seven" name="e_top_left_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_left_eight')" id="e_top_left_eight" name="e_top_left_eight" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_left_eight" name="e_top_left_eight" value="No">
                    </div>
                    
                    <!-- Top Rigth -->
                    <div class="col border-bottom border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_one')" id="e_top_right_one" name="e_top_right_one" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_one" name="e_top_right_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_two')" id="e_top_right_two" name="e_top_right_two" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_two" name="e_top_right_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_three')" id="e_top_right_three" name="e_top_right_three" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_three" name="e_top_right_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_four')" id="e_top_right_four" name="e_top_right_four" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_four" name="e_top_right_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_five')" id="e_top_right_five" name="e_top_right_five" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_five" name="e_top_right_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_six')" id="e_top_right_six" name="e_top_right_six" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_six" name="e_top_right_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_seven')" id="e_top_right_seven" name="e_top_right_seven" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_seven" name="e_top_right_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_top_right_eight')" id="e_top_right_eight" name="e_top_right_eight" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_top_right_eight" name="e_top_right_eight" value="No">
                    </div>
                    
                    <!-- Bot Left -->
                    <div class="col border-top border-right border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_one')" id="e_bot_left_one" name="e_bot_left_one" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_one" name="e_bot_left_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_two')" id="e_bot_left_two" name="e_bot_left_two" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_two" name="e_bot_left_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_three')" id="e_bot_left_three" name="e_bot_left_three" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_three" name="e_bot_left_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_four')" id="e_bot_left_four" name="e_bot_left_four" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_four" name="e_bot_left_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_five')" id="e_bot_left_five" name="e_bot_left_five" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_five" name="e_bot_left_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_six')" id="e_bot_left_six" name="e_bot_left_six" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_six" name="e_bot_left_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_seven')" id="e_bot_left_seven" name="e_bot_left_seven" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_seven" name="e_bot_left_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_left_eight')" id="e_bot_left_eight" name="e_bot_left_eight" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_left_eight" name="e_bot_left_eight" value="No">
                    </div>
                    
                    <!-- Bot Rigth -->
                    <div class="col border-top border-left border-dark border-3 text-center">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_one')" id="e_bot_right_one" name="e_bot_right_one" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_one" name="e_bot_right_one" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_two')" id="e_bot_right_two" name="e_bot_right_two" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_two" name="e_bot_right_two" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_three')" id="e_bot_right_three" name="e_bot_right_three" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_three" name="e_bot_right_three" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_four')" id="e_bot_right_four" name="e_bot_right_four" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_four" name="e_bot_right_four" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_five')" id="e_bot_right_five" name="e_bot_right_five" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_five" name="e_bot_right_five" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_six')" id="e_bot_right_six" name="e_bot_right_six" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_six" name="e_bot_right_six" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_seven')" id="e_bot_right_seven" name="e_bot_right_seven" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_seven" name="e_bot_right_seven" value="No">
                        <input type="checkbox" class="mx-2" onchange="toggleHidden('e_bot_right_eight')" id="e_bot_right_eight" name="e_bot_right_eight" value="Yes" disabled>
                        <input type="hidden" class="all-extraction" id="mini_e_bot_right_eight" name="e_bot_right_eight" value="No">
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Seventh Row -->
        <div class="row py-2 my-1">
            <div class="col">
                @if($dental_exam->dental_exam_result->prosthodontic_restoration === 'Yes')
                <input type="checkbox" id="prosthodontic_restoration" class="customize-checkbox" name="prosthodontic_restoration" value="Yes" onchange="toggleCheck(this, 'prosthodontic_restoration')" checked>
                <input type="hidden" id="self_prosthodontic_restoration" name="prosthodontic_restoration" value="No" disabled>
                @else
                <input type="checkbox" id="prosthodontic_restoration" class="customize-checkbox" name="prosthodontic_restoration" value="Yes" onchange="toggleCheck(this, 'prosthodontic_restoration')">
                <input type="hidden" id="self_prosthodontic_restoration" name="prosthodontic_restoration" value="No">
                @endif
                <span class="info h3"><strong>Prosthodontic Restoration</strong></span>
            </div>
            <div class="col">
                @if($dental_exam->dental_exam_result->prosthodontic_restoration === 'Yes')
                <textarea class="form-control" id="prosthodontic_restoration_result" name="prosthodontic_restoration_result" row="2">{{ $dental_exam->dental_exam_result->prosthodontic_restoration_result }}</textarea>
                @else
                <textarea class="form-control" id="prosthodontic_restoration_result" name="prosthodontic_restoration_result" row="2" disabled>Not Applicable</textarea>
                @endif
            </div>
        </div>

        <!-- Eighth Row -->
        <div class="row py-2 my-1">
            <div class="col">
                @if($dental_exam->dental_exam_result->orthodontist === 'Yes')
                <input type="checkbox" id="orthodontist" class="customize-checkbox" name="orthodontist" value="Yes" onchange="toggleCheck(this, 'orthodontist')" checked>
                <input type="hidden" id="self_orthodontist" name="orthodontist" value="No" disabled>
                @else
                <input type="checkbox" id="orthodontist" class="customize-checkbox" name="orthodontist" value="Yes" onchange="toggleCheck(this, 'orthodontist')">
                <input type="hidden" id="self_orthodontist" name="orthodontist" value="No">
                @endif
                <span class="info h3"><strong>See an Orthodontist</strong></span>
            </div>
            <div class="col">
                @if($dental_exam->dental_exam_result->orthodontist === 'Yes')
                <textarea class="form-control" id="orthodontist_result" name="orthodontist_result" row="2">{{ $dental_exam->dental_exam_result->orthodontist_result }}</textarea>
                @else
                <textarea class="form-control" id="orthodontist_result" name="orthodontist_result" row="2" disabled>Not Applicable</textarea>
                @endif
            </div>
        </div>

        <!-- Submit -->
        <div class="position-right ml-auto my-2" style="width: 75px;">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop

<!-- CSS -->
@section('css')
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="/css/admin_custom.css">

    <!-- ZomProj css -->
    <link rel="stylesheet" href="{{ asset('assets/css/record/zomproj-record.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/record/zomproj-record-de.css') }}">
@stop

<!-- JavaScript -->
@section('js')
<!-- JQuery CDN (Content Delivery Network) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap package -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Get Current Date -->
<script>
    $(document).ready(function(){
        const date = new Date();
        var currentDate = document.getElementById("current_date");

        // Format the date as "YYYY-MM-DD"
        var formattedDate = date.toISOString().split('T')[0];

        currentDate.value = formattedDate;
    });
</script>

<!-- Checkbox -->
<script>
    function toggleHidden(checkboxId) {
        var hidden = document.getElementById("mini_" + checkboxId);
        var checkbox = document.getElementById(checkboxId);
        if (!checkbox.checked) {
            hidden.disabled = false;
        }else{
            hidden.disabled = true;
        }
    }

    function toggleCheck(checkbox, checkboxId) {
        //Oral Prophylaxis
        const oral_prophylaxis_result = document.getElementById('oral_prophylaxis_result');
        
        //Restoration
        const r_top_left_one = document.getElementById('r_top_left_one');
        const r_top_left_two = document.getElementById('r_top_left_two');
        const r_top_left_three = document.getElementById('r_top_left_three');
        const r_top_left_four = document.getElementById('r_top_left_four');
        const r_top_left_five = document.getElementById('r_top_left_five');
        const r_top_left_six = document.getElementById('r_top_left_six');
        const r_top_left_seven = document.getElementById('r_top_left_seven');
        const r_top_left_eight = document.getElementById('r_top_left_eight');
        const r_top_right_one = document.getElementById('r_top_right_one');
        const r_top_right_two = document.getElementById('r_top_right_two');
        const r_top_right_three = document.getElementById('r_top_right_three');
        const r_top_right_four = document.getElementById('r_top_right_four');
        const r_top_right_five = document.getElementById('r_top_right_five');
        const r_top_right_six = document.getElementById('r_top_right_six');
        const r_top_right_seven = document.getElementById('r_top_right_seven');
        const r_top_right_eight = document.getElementById('r_top_right_eight');
        const r_bot_left_one = document.getElementById('r_bot_left_one');
        const r_bot_left_two = document.getElementById('r_bot_left_two');
        const r_bot_left_three = document.getElementById('r_bot_left_three');
        const r_bot_left_four = document.getElementById('r_bot_left_four');
        const r_bot_left_five = document.getElementById('r_bot_left_five');
        const r_bot_left_six = document.getElementById('r_bot_left_six');
        const r_bot_left_seven = document.getElementById('r_bot_left_seven');
        const r_bot_left_eight = document.getElementById('r_bot_left_eight');
        const r_bot_right_one = document.getElementById('r_bot_right_one');
        const r_bot_right_two = document.getElementById('r_bot_right_two');
        const r_bot_right_three = document.getElementById('r_bot_right_three');
        const r_bot_right_four = document.getElementById('r_bot_right_four');
        const r_bot_right_five = document.getElementById('r_bot_right_five');
        const r_bot_right_six = document.getElementById('r_bot_right_six');
        const r_bot_right_seven = document.getElementById('r_bot_right_seven');
        const r_bot_right_eight = document.getElementById('r_bot_right_eight');

        //Extraction
        const e_top_left_one = document.getElementById('e_top_left_one');
        const e_top_left_two = document.getElementById('e_top_left_two');
        const e_top_left_three = document.getElementById('e_top_left_three');
        const e_top_left_four = document.getElementById('e_top_left_four');
        const e_top_left_five = document.getElementById('e_top_left_five');
        const e_top_left_six = document.getElementById('e_top_left_six');
        const e_top_left_seven = document.getElementById('e_top_left_seven');
        const e_top_left_eight = document.getElementById('e_top_left_eight');
        const e_top_right_one = document.getElementById('e_top_right_one');
        const e_top_right_two = document.getElementById('e_top_right_two');
        const e_top_right_three = document.getElementById('e_top_right_three');
        const e_top_right_four = document.getElementById('e_top_right_four');
        const e_top_right_five = document.getElementById('e_top_right_five');
        const e_top_right_six = document.getElementById('e_top_right_six');
        const e_top_right_seven = document.getElementById('e_top_right_seven');
        const e_top_right_eight = document.getElementById('e_top_right_eight');
        const e_bot_left_one = document.getElementById('e_bot_left_one');
        const e_bot_left_two = document.getElementById('e_bot_left_two');
        const e_bot_left_three = document.getElementById('e_bot_left_three');
        const e_bot_left_four = document.getElementById('e_bot_left_four');
        const e_bot_left_five = document.getElementById('e_bot_left_five');
        const e_bot_left_six = document.getElementById('e_bot_left_six');
        const e_bot_left_seven = document.getElementById('e_bot_left_seven');
        const e_bot_left_eight = document.getElementById('e_bot_left_eight');
        const e_bot_right_one = document.getElementById('e_bot_right_one');
        const e_bot_right_two = document.getElementById('e_bot_right_two');
        const e_bot_right_three = document.getElementById('e_bot_right_three');
        const e_bot_right_four = document.getElementById('e_bot_right_four');
        const e_bot_right_five = document.getElementById('e_bot_right_five');
        const e_bot_right_six = document.getElementById('e_bot_right_six');
        const e_bot_right_seven = document.getElementById('e_bot_right_seven');
        const e_bot_right_eight = document.getElementById('e_bot_right_eight');

        //Prosthodontic Restoration
        const prosthodontic_restoration_result = document.getElementById('prosthodontic_restoration_result');
        
        //Orthodontist
        const orthodontist_result = document.getElementById('orthodontist_result');

        //Self
        const self = document.getElementById('self_'+ checkboxId)
        const all_restorations = document.querySelectorAll('.all-restoration');
        const all_extractions = document.querySelectorAll('.all-extraction');

        if (checkbox.checked) {
            checkbox.value = "Yes";
            if (checkboxId === 'oral_prophylaxis'){
                self.disabled = true;
                oral_prophylaxis_result.disabled = false;
                oral_prophylaxis_result.value = "";
            } else if (checkboxId === 'restoration'){
                self.disabled = true;
                all_restorations.forEach(function (all_restoration) {
                    all_restoration.disabled = true;
                });
                r_top_left_one.disabled = false;
                r_top_left_two.disabled = false;
                r_top_left_three.disabled = false;
                r_top_left_four.disabled = false;
                r_top_left_five.disabled = false;
                r_top_left_six.disabled = false;
                r_top_left_seven.disabled = false;
                r_top_left_eight.disabled = false;
                r_top_right_one.disabled = false;
                r_top_right_two.disabled = false;
                r_top_right_three.disabled = false;
                r_top_right_four.disabled = false;
                r_top_right_five.disabled = false;
                r_top_right_six.disabled = false;
                r_top_right_seven.disabled = false;
                r_top_right_eight.disabled = false;
                r_bot_left_one.disabled = false;
                r_bot_left_two.disabled = false;
                r_bot_left_three.disabled = false;
                r_bot_left_four.disabled = false;
                r_bot_left_five.disabled = false;
                r_bot_left_six.disabled = false;
                r_bot_left_seven.disabled = false;
                r_bot_left_eight.disabled = false;
                r_bot_right_one.disabled = false;
                r_bot_right_two.disabled = false;
                r_bot_right_three.disabled = false;
                r_bot_right_four.disabled = false;
                r_bot_right_five.disabled = false;
                r_bot_right_six.disabled = false;
                r_bot_right_seven.disabled = false;
                r_bot_right_eight.disabled = false;
            } else if (checkboxId === 'extraction'){
                self.disabled = true;
                all_extractions.forEach(function (all_extraction) {
                    all_extraction.disabled = true;
                });
                e_top_left_one.disabled = false;
                e_top_left_two.disabled = false;
                e_top_left_three.disabled = false;
                e_top_left_four.disabled = false;
                e_top_left_five.disabled = false;
                e_top_left_six.disabled = false;
                e_top_left_seven.disabled = false;
                e_top_left_eight.disabled = false;
                e_top_right_one.disabled = false;
                e_top_right_two.disabled = false;
                e_top_right_three.disabled = false;
                e_top_right_four.disabled = false;
                e_top_right_five.disabled = false;
                e_top_right_six.disabled = false;
                e_top_right_seven.disabled = false;
                e_top_right_eight.disabled = false;
                e_bot_left_one.disabled = false;
                e_bot_left_two.disabled = false;
                e_bot_left_three.disabled = false;
                e_bot_left_four.disabled = false;
                e_bot_left_five.disabled = false;
                e_bot_left_six.disabled = false;
                e_bot_left_seven.disabled = false;
                e_bot_left_eight.disabled = false;
                e_bot_right_one.disabled = false;
                e_bot_right_two.disabled = false;
                e_bot_right_three.disabled = false;
                e_bot_right_four.disabled = false;
                e_bot_right_five.disabled = false;
                e_bot_right_six.disabled = false;
                e_bot_right_seven.disabled = false;
                e_bot_right_eight.disabled = false;
            } else if (checkboxId === 'prosthodontic_restoration'){
                self.disabled = true;
                prosthodontic_restoration_result.disabled = false;
                prosthodontic_restoration_result.value = "";
            } else if (checkboxId === 'orthodontist'){
                self.disabled = true;
                orthodontist_result.disabled = false;
                orthodontist_result.value = "";
            }
        } else {
            checkbox.value = "No"; 
            if (checkboxId === 'oral_prophylaxis'){
                self.disabled = false;
                oral_prophylaxis_result.disabled = true;
                oral_prophylaxis_result.value = "Not Applicable";
            } else if (checkboxId === 'restoration'){
                self.disabled = false;
                all_restorations.forEach(function (all_restoration) {
                    all_restoration.disabled = false;
                });
                r_top_left_one.disabled = true;
                r_top_left_two.disabled = true;
                r_top_left_three.disabled = true;
                r_top_left_four.disabled = true;
                r_top_left_five.disabled = true;
                r_top_left_six.disabled = true;
                r_top_left_seven.disabled = true;
                r_top_left_eight.disabled = true;
                r_top_right_one.disabled = true;
                r_top_right_two.disabled = true;
                r_top_right_three.disabled = true;
                r_top_right_four.disabled = true;
                r_top_right_five.disabled = true;
                r_top_right_six.disabled = true;
                r_top_right_seven.disabled = true;
                r_top_right_eight.disabled = true;
                r_bot_left_one.disabled = true;
                r_bot_left_two.disabled = true;
                r_bot_left_three.disabled = true;
                r_bot_left_four.disabled = true;
                r_bot_left_five.disabled = true;
                r_bot_left_six.disabled = true;
                r_bot_left_seven.disabled = true;
                r_bot_left_eight.disabled = true;
                r_bot_right_one.disabled = true;
                r_bot_right_two.disabled = true;
                r_bot_right_three.disabled = true;
                r_bot_right_four.disabled = true;
                r_bot_right_five.disabled = true;
                r_bot_right_six.disabled = true;
                r_bot_right_seven.disabled = true;
                r_bot_right_eight.disabled = true;
                r_top_left_one.checked = false;
                r_top_left_two.checked = false;
                r_top_left_three.checked = false;
                r_top_left_four.checked = false;
                r_top_left_five.checked = false;
                r_top_left_six.checked = false;
                r_top_left_seven.checked = false;
                r_top_left_eight.checked = false;
                r_top_right_one.checked = false;
                r_top_right_two.checked = false;
                r_top_right_three.checked = false;
                r_top_right_four.checked = false;
                r_top_right_five.checked = false;
                r_top_right_six.checked = false;
                r_top_right_seven.checked = false;
                r_top_right_eight.checked = false;
                r_bot_left_one.checked = false;
                r_bot_left_two.checked = false;
                r_bot_left_three.checked = false;
                r_bot_left_four.checked = false;
                r_bot_left_five.checked = false;
                r_bot_left_six.checked = false;
                r_bot_left_seven.checked = false;
                r_bot_left_eight.checked = false;
                r_bot_right_one.checked = false;
                r_bot_right_two.checked = false;
                r_bot_right_three.checked = false;
                r_bot_right_four.checked = false;
                r_bot_right_five.checked = false;
                r_bot_right_six.checked = false;
                r_bot_right_seven.checked = false;
                r_bot_right_eight.checked = false;
            } else if (checkboxId === 'extraction'){
                self.disabled = false;
                all_extractions.forEach(function (all_extraction) {
                    all_extraction.disabled = false;
                });
                e_top_left_one.disabled = true;
                e_top_left_two.disabled = true;
                e_top_left_three.disabled = true;
                e_top_left_four.disabled = true;
                e_top_left_five.disabled = true;
                e_top_left_six.disabled = true;
                e_top_left_seven.disabled = true;
                e_top_left_eight.disabled = true;
                e_top_right_one.disabled = true;
                e_top_right_two.disabled = true;
                e_top_right_three.disabled = true;
                e_top_right_four.disabled = true;
                e_top_right_five.disabled = true;
                e_top_right_six.disabled = true;
                e_top_right_seven.disabled = true;
                e_top_right_eight.disabled = true;
                e_bot_left_one.disabled = true;
                e_bot_left_two.disabled = true;
                e_bot_left_three.disabled = true;
                e_bot_left_four.disabled = true;
                e_bot_left_five.disabled = true;
                e_bot_left_six.disabled = true;
                e_bot_left_seven.disabled = true;
                e_bot_left_eight.disabled = true;
                e_bot_right_one.disabled = true;
                e_bot_right_two.disabled = true;
                e_bot_right_three.disabled = true;
                e_bot_right_four.disabled = true;
                e_bot_right_five.disabled = true;
                e_bot_right_six.disabled = true;
                e_bot_right_seven.disabled = true;
                e_bot_right_eight.disabled = true;
                e_top_left_one.checked = false;
                e_top_left_two.checked = false;
                e_top_left_three.checked = false;
                e_top_left_four.checked = false;
                e_top_left_five.checked = false;
                e_top_left_six.checked = false;
                e_top_left_seven.checked = false;
                e_top_left_eight.checked = false;
                e_top_right_one.checked = false;
                e_top_right_two.checked = false;
                e_top_right_three.checked = false;
                e_top_right_four.checked = false;
                e_top_right_five.checked = false;
                e_top_right_six.checked = false;
                e_top_right_seven.checked = false;
                e_top_right_eight.checked = false;
                e_bot_left_one.checked = false;
                e_bot_left_two.checked = false;
                e_bot_left_three.checked = false;
                e_bot_left_four.checked = false;
                e_bot_left_five.checked = false;
                e_bot_left_six.checked = false;
                e_bot_left_seven.checked = false;
                e_bot_left_eight.checked = false;
                e_bot_right_one.checked = false;
                e_bot_right_two.checked = false;
                e_bot_right_three.checked = false;
                e_bot_right_four.checked = false;
                e_bot_right_five.checked = false;
                e_bot_right_six.checked = false;
                e_bot_right_seven.checked = false;
                e_bot_right_eight.checked = false;
            } else if (checkboxId === 'prosthodontic_restoration'){
                self.disabled = false;
                prosthodontic_restoration_result.disabled = true;
                prosthodontic_restoration_result.value = "Not Applicable";
            } else if (checkboxId === 'orthodontist'){
                self.disabled = false;
                orthodontist_result.disabled = true;
                orthodontist_result.value = "Not Applicable"
            }
        }
    }
</script>
@stop