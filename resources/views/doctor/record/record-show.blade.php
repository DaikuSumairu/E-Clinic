@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Health Record')

<!-- Content Header -->
@section('content_header')
    <h1>Health Record for {{ $record->user->name }}</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Go back from the last page -->
<a class="btn btn-danger mb-2" href="{{ route('doctor.recordIndex') }}">Go Back</a>

<!-- Body -->
<div class="container-xxl border mb-2 record-customize-show-container-height">
    <!-- General Head -->
    <div class="row mx-auto mt-4 mb-2 record-show-info-header">
        <!-- Left Side -->
        <div class="col">
            <div class="row-col-1 py-3" >
                <!-- Patient's Name -->
                <div class="col my-1">
                    <label class="info"><b>Name:</b></label>
                    <span class="info">{{ $record->user->name }}</span>
                </div>

                <!-- Patient's School ID -->
                <div class="col my-1">
                    <label class="info"><b>ID:</b></label>
                    <span class="info">{{ $record->user->school_id }}</span>
                </div>

                <!-- Patient's Grade, Year, or Specialization -->
                <div class="col my-1">
                    @if($record->user->role->role == 'Student')
                        @if($record->user->grade)
                        <label class="info"><b>Grade:</b></label>
                        <span class="info">{{ $record->user->grade }}</span>
                        @elseif($record->user->year)
                        <label class="info"><b>Year:</b></label>
                        <span class="info">{{ $record->user->year }}</span>
                        @endif
                    @else
                    <label class="info"><b>Specialization:</b></label>
                    <span class="info">{{ $record->user->specialization }}</span>
                    @endif
                </div>
                
                <!-- Patient's Course and Section (Student) -->
                @if($record->user->role->role == 'Student')
                <div class="col my-1">
                    <label class="info"><b>Course:</b></label>
                    <span class="info">{{ $record->user->course }}</span>
                </div>
                
                <div class="col my-1">
                    <label class="info"><b>Section:</b></label>
                    <span class="info">{{ $record->user->section }}</span>
                </div>
                @endif

                <!-- Patient's Mobile Number -->
                <div class="col my-1">
                    <label class="info"><b>Mobile Number:</b></label>
                    <span class="info">{{ $record->mobile_number }}</span>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col">
            <div class="row-col-1 py-3">
                
                <!-- Patient's Birth Date -->
                <div class="col my-1">
                    <label class="info"><b>Birth Date:</b></label>
                    <span class="info">{{ $record->birth_date->format('F d, Y') }}</span>
                </div>
                
                <!-- Patient's Age -->
                <div class="col my-1">
                    <label class="info"><b>Age:</b></label>
                    <span class="info">{{ $record->age }}</span>
                </div>
                
                <!-- Patient's Sex -->
                <div class="col my-1">
                    <label class="info"><b>Sex:</b></label>
                    <span class="info">{{ $record->sex }}</span>
                </div>
                
                <!-- Patient's Civil Status -->
                <div class="col my-1">
                    <label class="info"><b>Civil Status:</b></label>
                    <span class="info">{{ $record->civil_status }}</span>
                </div>
                
                <!-- Patient's Address -->
                <div class="col my-1">
                    <label class="info"><b>Address:</b></label>
                    <span class="info">{{ $record->address }}, </span>
                    <span class="info">{{ $record->street }}, </span>
                    <span class="info">{{ $record->city }}, </span>
                    <span class="info">{{ $record->province }}, </span>
                    <span class="info">{{ $record->zip }}</span>
                </div>
                
                <!-- Patient's Contact Person -->
                <div class="col my-1">
                    <label class="info"><b>Contact Person:</b></label>
                    <span class="info">{{ $record->contact_person }}</span>
                </div>
                
                <!-- Patient's Contact Person Number -->
                <div class="col my-1">
                    <label class="info"><b>Contact Person Number:</b></label>
                    <span class="info">{{ $record->contact_person_number }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Consultation -->
    <div class="record-show-consultation-header border-top border-bottom border-secondary btn-info mx-auto text-center" id="consultation-header">
        <label class="info h4">Consultation</label>
    </div>
    <!-- If user doesn't have made Consultation -->
    <div class="border border-secondary mx-auto text-center" id="consultation-content-empty">
        <span class="info">No Consultation has been made, would you like to <a href="{{ route('doctor.consultationCreate', $record->id ) }}">Create</a>?</span> 
    </div>
    <!-- If user have made Consultation -->
    <div class="border border-secondary mx-auto" id="consultation-content">
        @if(isset($record->consultations))
        <!-- Date that being created (Automated) -->
        <!-- Options -->
        <div class="row mx-auto my-1">
            <div class="col pt text-left" id="consultation_header" style="display: none;">
            </div>
            <div class="col pt text-left" id="default_consultation_header">
                <a class="info btn btn-primary" href="{{ route('doctor.consultationCreate', $record->id ) }}">Create</a>
            </div>
            <div class="col pt-2 text-right">
                <i class="far fa-calendar"></i>
                <select class="info" id="consultation_date" name="consultation_date">
                    <option selected disabled hidden>Select Date</option>
                    @foreach($record->consultations as $consultation)
                        @if($consultation->id )
                            @php
                            $dateToShow = $consultation->date_created; // Default to date_created

                            if ($consultation->date_updated && is_null($consultation->date_finished)) {
                                $dateToShow = $consultation->date_updated;
                            } elseif ((is_null($consultation->date_updated) && $consultation->date_finished) || ($consultation->date_updated && $consultation->date_finished)) {
                                $dateToShow = $consultation->date_finished;
                            }
                            @endphp
                        <option data-status="{{ $consultation->consultation_response->remarks }}"
                                data-consultation_date="{{ $consultation->date_created->format('m-d-Y') }}"
                                class="@if($consultation->consultation_response->remarks === 'Monitoring Case') 
                                            text-warning 
                                        @else 
                                            text-success 
                                        @endif"
                                value="{{ $consultation->id }}">
                            {{ $dateToShow->format('F d, Y') }}
                        </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <!-- First Row -->
        <div class="border border-2 row row-cols-2 pt-2 mt-2 mx-auto" id="consultation_1" style="display: none;">
        </div>
            
        <!-- Second Row -->
        <div class="border border-2 row row-cols-1 mt-1 pt-2 mx-auto" id="consultation_2" style="display: none;">
        </div>
        
        <!-- Third Row -->
        <div class="border border-2 row row-cols-1 mt-1 py-2 mx-auto" id="consultation_3" style="display: none;">
        </div>
        
        <!-- Fourth Row -->
        <div class="border border-2 row row-cols-1 my-1 py-1 mx-auto" id="consultation_4" style="display: none;">
        </div>
        @endif
    </div>
    

    <!-- Medical Medical -->
    <div class="record-show-medical-exam-header border-top border-bottom border-secondary btn-info mx-auto mx-auto text-center" id="medical-exam-header">
        <label class="info h4">Medical Exam</label>
    </div>
    <!-- If user doesn't have made Medical Exam -->
    <div class="border border-secondary mx-auto text-center" id="medical-exam-content-empty">
        <span class="info">No Medical Exam has been made, would you like to <a href="{{ route('doctor.medicalExamCreate', $record->id ) }}">Create</a>?</span> 
    </div>
    <!-- If user have made Medical Exam -->
    <div class="border border-secondary mx-auto" id="medical-exam-content">
    @if(isset($record->medical_exams))
        <!-- Date that being created (Automated) -->
        <!-- Options -->
        <div class="row mx-auto my-1">
            <div class="col pt text-left" id="medical_exam_header" style="display: none;">
            </div>
            <div class="col pt-2 text-right">
                <i class="far fa-calendar"></i>
                <select class="info" id="medical_exam_date" name="medical_exam_date">
                    <option selected disabled hidden>Select Date</option>
                    @foreach($record->medical_exams as $medical_exam)
                        @if($medical_exam->id )
                            <option 
                                @if($medical_exam->date_created && is_null($medical_exam->date_updated))
                                    data-date-created="{{ $medical_exam->date_created->format('m-d-Y') }}"
                                @elseif($medical_exam->date_updated && is_null($medical_exam->date_created))
                                    data-date-updated="{{ $medical_exam->date_updated->format('m-d-Y') }}"
                                @else
                                    data-id="{{ $medical_exam->id }}"
                                @endif

                                class="@if($medical_exam->date_updated && is_null($medical_exam->date_created)) text-info @endif"
                                value="{{ $medical_exam->id }}">
                                @if($medical_exam->date_created || ($medical_exam->date_created && $medical_exam->date_updated))
                                    {{ $medical_exam->date_created->format('F d, Y') }}
                                @elseif($medical_exam->date_updated)
                                    {{ $medical_exam->date_updated->format('F d, Y') }}
                                @endif
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <!-- First Row -->
        <div class="border border-2 row pt-2 mt-2 mx-auto" id="medical_exam_1" style="display: none;">
        </div>
            
        <!-- Second Row -->
        <div class="border border-2 row mt-1 pt-2 mx-auto" id="medical_exam_2" style="display: none;">
        </div>
        
        <!-- Third Row -->
        <div class="border border-2 row mt-1 py-2 mx-auto" id="medical_exam_3" style="display: none;">
        </div>
        
        <!-- Fourth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="medical_exam_4" style="display: none;">
        </div>
        
        <!-- Fifth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="medical_exam_5" style="display: none;">
        </div>
        
        <!-- Sixth Row -->
        <div class="border border-2 row row-cols-1 my-1 py-1 mx-auto" id="medical_exam_6" style="display: none;">
        </div>
    @endif
    </div>
    
    <!-- Dental Record -->
    <div class="record-show-dental-exam-header border-top border-bottom border-secondary btn-info mx-auto mx-auto text-center" id="dental-exam-header">
        <label class="info h4">Dental Exam</label>
    </div>
    <!-- If user doesn't have made Dental Exam -->
    <div class="border border-secondary mx-auto text-center" id="dental-exam-content-empty">
        <span class="info">No Dental Exam has been made, only the dentist can provide this area.</span> 
    </div>
    <!-- If user have made Dental Exam -->
    <div class="border border-secondary mx-auto" id="dental-exam-content">
    @if(isset($record->dental_exams))
        <!-- Date that being created (Automated) -->
        <!-- Options -->
        <div class="row mx-auto my-1">
            <div class="col pt text-left" id="dental_exam_header" style="display: none;">
            </div>
            <div class="col pt-2 text-right">
                <i class="far fa-calendar"></i>
                <select class="info" id="dental_exam_date" name="dental_exam_date">
                    <option selected disabled hidden>Select Date</option>
                    @foreach($record->dental_exams as $dental_exam)
                        @if($dental_exam->id )
                            <option 
                                @if($dental_exam->date_created && is_null($dental_exam->date_updated))
                                    data-date-created="{{ $dental_exam->date_created->format('m-d-Y') }}"
                                @elseif($dental_exam->date_updated && is_null($dental_exam->date_created))
                                    data-date-updated="{{ $dental_exam->date_updated->format('m-d-Y') }}"
                                @else
                                    data-id="{{ $dental_exam->id }}"
                                @endif

                                class="@if($dental_exam->date_updated && is_null($dental_exam->date_created)) text-info @endif"
                                value="{{ $dental_exam->id }}">
                                @if($dental_exam->date_created || ($dental_exam->date_created && $dental_exam->date_updated))
                                    {{ $dental_exam->date_created->format('F d, Y') }}
                                @elseif($dental_exam->date_updated)
                                    {{ $dental_exam->date_updated->format('F d, Y') }}
                                @endif
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <!-- First Row -->
        <div class="border border-2 row pt-2 mt-2 mx-auto" id="dental_exam_1" style="display: none;">
        </div>
            
        <!-- Second Row -->
        <div class="border border-2 row mt-1 pt-2 mx-auto" id="dental_exam_2" style="display: none;">
        </div>
        
        <!-- Third Row -->
        <div class="border border-2 row mt-1 py-2 mx-auto" id="dental_exam_3" style="display: none;">
        </div>
        
        <!-- Fourth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="dental_exam_4" style="display: none;">
        </div>
        
        <!-- Fifth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="dental_exam_5" style="display: none;">
        </div>
        
        <!-- Sixth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="dental_exam_6" style="display: none;">
        </div>
        
        <!-- Sixth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="dental_exam_7" style="display: none;">
        </div>
        
        <!-- Sixth Row -->
        <div class="border border-2 row my-1 py-1 mx-auto" id="dental_exam_8" style="display: none;">
        </div>
    @endif
    </div>
</div>
@stop

<!-- CSS -->
@section('css')
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="/css/admin_custom.css">

    <!-- ZomProj css -->
    <link rel="stylesheet" href="{{ asset('assets/css/record/zomproj-record.css') }}">
    
    <!-- Google Font css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
@stop

<!-- JavaScript -->
@section('js')
<!-- JQuery CDN (Content Delivery Network) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap package -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Sticky Header -->
<script>
    $(document).ready(function () {
        // When the consultation-header is clicked
        $("#consultation-header").click(function () {
            @if ($record->consultations->where('record_id', $record->id)->isNotEmpty())
            // Show consultation-content
            $("#consultation-content").slideToggle(500);
            @else
            // Show consultation-empty-content
            $("#consultation-content-empty").slideToggle(100);
            @endif;
        });
        
        // When the medical-exam-header is clicked
        $("#medical-exam-header").click(function () {
            @if ($record->medical_exams->where('record_id', $record->id)->isNotEmpty())
            // Show consultation-content
            $("#medical-exam-content").slideToggle(500);
            @else
            // Show consultation-empty-content
            $("#medical-exam-content-empty").slideToggle(100);
            @endif;
        });
        
        // When the dental-exam-header is clicked
        $("#dental-exam-header").click(function () {
            @if ($record->dental_exams->where('record_id', $record->id)->isNotEmpty())
            // Show consultation-content
            $("#dental-exam-content").slideToggle(500);
            @else
            // Show consultation-empty-content
            $("#dental-exam-content-empty").slideToggle(100);
            @endif;
        });
    });
</script>

<!-- Customize Select (Consultation) -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var consultation_date = document.getElementById('consultation_date');
        var medical_exam_date = document.getElementById('medical_exam_date');
        var dental_exam_date = document.getElementById('dental_exam_date');

        consultation_date.addEventListener('change', function () {
            // Get the selected option from the consultation_date dropdown
            var selectedConsultationOption = this.options[this.selectedIndex];
            
            // Get the status and ID from the selected option
            var status = selectedConsultationOption.getAttribute('data-status');
            var selectedConsultationID = selectedConsultationOption.value; // Get the selected consultation ID
            
            // Get the record ID and consultation date from the Blade template
            var recordId = '{{ $record->id }}';
            var consultationDate = $('#consultation_date option:selected').data('consultation_date');

            // Show/hide elements based on the selected option
            switch (status) {
                case 'Monitoring Case':
                case 'Resolved Case':
                    $('#consultation_header, #consultation_1, #consultation_2, #consultation_3, #consultation_4').show();
                    $('#default_consultation_header').hide();
                    break;
                default:
                    // Hide elements for other cases
                    $('#consultation_header, #consultation_1, #consultation_2, #consultation_3, #consultation_4').hide();
            }

            // Toggle text color class based on the status
            $(this).toggleClass('text-warning', status === 'Monitoring Case')
                .toggleClass('text-success', status === 'Resolved Case');

            // Get specific data for the chosen date and consultation ID using AJAX
            $.ajax({
                type: 'GET',
                url: '/doctor/record/' + recordId + '/consultation/',
                data: { 'consultation_id': selectedConsultationID, 'date': consultationDate }, // Send consultation ID and date
                success: function (data) {
                    // Assuming the data structure has properties like first_output, second_output, etc.
                    $('#consultation_header').html(data.consultation_output);
                    $('#consultation_1').html(data.first_output);
                    $('#consultation_2').html(data.second_output);
                    $('#consultation_3').html(data.third_output);
                    $('#consultation_4').html(data.fourth_output);
                },
            });
        });

        medical_exam_date.addEventListener('change', function(){
            var selectedMEOption = $(this).find(':selected');
            var selectedMedicalExamID = selectedMEOption.val();
            var selectedME_created = selectedMEOption.data('date-created');
            var selectedME_update = selectedMEOption.data('date-updated');
            var selectedME_id = selectedMEOption.data('id');
            var recordId = '{{ $record->id }}';

            // Show medical exam rows when an option is selected
            if (selectedMEOption) {
                $('#medical_exam_header, #medical_exam_1, #medical_exam_2, #medical_exam_3, #medical_exam_4, #medical_exam_5, #medical_exam_6').show();
            }

            if (selectedME_update) {
                $(this).addClass('text-info');
            } else {
                $(this).removeClass('text-info');
            }
            
            $.ajax({
                type: 'GET',
                url: '/doctor/record/' + recordId + '/medical-exam/',
                data: { 'medical_exam_id': selectedMedicalExamID, 'date_created': selectedME_created, 'date_updated':selectedME_update, 'id': selectedME_id },
                success: function(data) {
                    // Handle the response and update your UI accordingly
                    $('#medical_exam_header').html(data.med_output);
                    $('#medical_exam_1').html(data.first_output);
                    $('#medical_exam_2').html(data.second_output);
                    $('#medical_exam_3').html(data.third_output);
                    $('#medical_exam_4').html(data.fourth_output);
                    $('#medical_exam_5').html(data.fifth_output);
                    $('#medical_exam_6').html(data.sixth_output);
                },
            });
        });

        dental_exam_date.addEventListener('change', function(){
            var selectedDEOption = $(this).find(':selected');
            var selectedDentalExamID = selectedDEOption.val();
            var selectedDE_created = selectedDEOption.data('date-created');
            var selectedDE_update = selectedDEOption.data('date-updated');
            var selectedDE_id = selectedDEOption.data('id');
            var recordId = '{{ $record->id }}';

            // Show medical exam rows when an option is selected
            if (selectedDEOption) {
                $('#dental_exam_header, #dental_exam_1, #dental_exam_2, #dental_exam_3, #dental_exam_4, #dental_exam_5, #dental_exam_6, #dental_exam_7, #dental_exam_8').show();
            }

            if (selectedDE_update) {
                $(this).addClass('text-info');
            } else {
                $(this).removeClass('text-info');
            }

            $.ajax({
                type: 'GET',
                url: '/doctor/record/' + recordId + '/dental-exam/',
                data: { 'dental_exam_id': selectedDentalExamID, 'date_created': selectedDE_created, 'date_updated':selectedDE_update, 'id': selectedDE_id },
                success: function(data) {
                    // Handle the response and update your UI accordingly
                    $('#dental_exam_header').html(data.den_output);
                    $('#dental_exam_1').html(data.first_output);
                    $('#dental_exam_2').html(data.second_output);
                    $('#dental_exam_3').html(data.third_output);
                    $('#dental_exam_4').html(data.fourth_output);
                    $('#dental_exam_5').html(data.fifth_output);
                    $('#dental_exam_6').html(data.sixth_output);
                    $('#dental_exam_7').html(data.seventh_output);
                    $('#dental_exam_8').html(data.eighth_output);
                },
            });
        });
    });
</script>
@stop