@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Creating Consultation')

<!-- Content Header -->
@section('content_header')
    <h1>Consultation for {{ $record->user->name }}</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Go back from the last page -->
<a class="btn btn-danger mb-2" href="{{ route('nurse.recordShow', $record->id) }}">Go Back</a>

<!-- Body -->
<div class="container-xxl mb-2 record-customize-create-container-height">
    <form method="POST" action="{{ route('nurse.consultationStore') }}" onsubmit="return confirm('Are you sure you want to create this consultation?');">
        @csrf
        <!-- Hidden value to be save on consultation -->
        <input type="hidden" name="record_id" value="{{ $record->id }}">

        <!-- Date that being created (Automated) -->
        <div class="row">
            <div class="col text-right pt-2">
                <i class="far fa-calendar"></i>
            </div>
            <div class="col-sm-2">
                <input type="date" class="form-control-plaintext" id="current_date" name="date_created" readonly>
            </div>
        </div>

        <!-- First Row -->
        <div class="border border-2 row row-cols-2 pt-2 mt-2 mx-auto">
            <!-- Complaint -->
            <div class="col-sm-2">
                <label class="info h2">* Complaint:</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="complaint" value="{{ old('complaint') }}" required>
            </div>
        </div>
            
        <!-- Second Row -->
        <div class="border border-2 row row-cols-1 mt-1 pt-2 mx-auto">
            <div class="col">
                <label class="info h3">Vital Signs:</label>
            </div>
            
            <div class="col mb-1">
                <!-- Vital Signs -->
                <div class="row mt-1 mx-auto">
                    <!-- Heart Rate -->
                    <div class="col pb-2 border border-1">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">* Pulse / Heart Rate:</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_pulse" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_pulse" style="display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <input type="number" class="vital_sign_input" id="pulse" name="pulse" value="{{ old('pulse') }}" required>
                                <span class="info">BPM</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- O2 Stat -->
                    <div class="col pb-2 border border-1">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">* O2 Stat:</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_oxygen" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_oxygen" style="display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <input type="number" class="vital_sign_input" id="oxygen" name="oxygen" value="{{ old('oxygen') }}" required>
                                <span class="info">%</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Respiratory Rate -->
                    <div class="col pb-2 border border-1">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">* Respiratory Rate:</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_respiratory_rate" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_respiratory_rate" style="display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <input type="number" class="vital_sign_input" id="respiratory_rate" name="respiratory_rate" value="{{ old('respiratory_rate') }}" required>
                                <span class="info">BPM</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Blood Pressure -->
                    <div class="col pb-2 border border-1">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">* Blood Pressure (mm/hg):</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_bp" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_bp" style="display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <input type="number" class="vital_sign_input" id="top_bp" name="top_bp" value="{{ old('top_bp') }}" required>
                                <span class="info">/</span>
                                <input type="number" class="vital_sign_input" id="bot_bp" name="bot_bp" value="{{ old('bot_bp') }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Temperature -->
                    <div class="col pb-2 border border-1">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">* Temperature:</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_temperature" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_temperature" style="display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <input type="number" class="vital_sign_input" id="temperature" name="temperature" step="any" value="{{ old('temperature') }}" required>
                                <span class="info">°C</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Third Row -->
        <div class="border border-2 row row-cols-1 mt-1 py-2 mx-auto">
            <div class="col">
                <label class="info h3">* Treatment:</label>
            </div>
            <div class="col">
                <textarea class="form-control" name="treatment" rows="3"></textarea>
            </div>
        </div>
        
        <!-- Fourth Row -->
        <div class="border border-2 row row-cols-1 mt-1 py-1 mx-auto">
            <div class="col">
                <label class="info h3">Nurse Remark:</label>
                <select name="remarks">
                    <option value="Monitoring Case">Monitoring Case</option>
                    <option value="Resolved Case">Resolved Case</option>
                </select>
            </div>
        </div>

        <!-- Submit -->
        <div class="position-right ml-auto mt-2" style="width: 75px;">
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
    <link rel="stylesheet" href="{{ asset('assets/css/record/zomproj-record-consultation.css') }}">
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

<!-- No add or less button on the right side of input number type -->
<style>
    /* Hide the up and down buttons */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    
    input[type="number"] {
        /* Adjust the padding to maintain the input's size */
        padding-right: 0;
        /* Optionally, you can disable resizing the input */
        resize: none;
    }
</style>

<!-- Restriction and Arrow determination of Cardiac Rate -->
<script>
    const cardiacRateInput = document.getElementById('pulse');
    const arrow_up_pulse = document.getElementById('arrow_up_pulse');
    const arrow_down_pulse = document.getElementById('arrow_down_pulse');

    cardiacRateInput.addEventListener('input', validateCardiacRate);

    function validateCardiacRate() {
        const cardiacRateValue = parseFloat(cardiacRateInput.value);

        if (cardiacRateValue < 60) {
            arrow_up_pulse.style.display = 'none';
            arrow_down_pulse.style.display = 'contents';
        } else if (cardiacRateValue > 100) {
            arrow_up_pulse.style.display = 'contents';
            arrow_down_pulse.style.display = 'none';
        } else {
            arrow_up_pulse.style.display = 'none';
            arrow_down_pulse.style.display = 'none';
        }
    }
</script>

<!-- Restriction and Arrow determination of O2 Stat -->
<script>
    const oxygenInput = document.getElementById('oxygen');
    const arrow_up_oxygen = document.getElementById('arrow_up_oxygen');
    const arrow_down_oxygen = document.getElementById('arrow_down_oxygen');

    oxygenInput.addEventListener('input', validateOxygen);

    function validateOxygen() {
        const oxygenValue = parseFloat(oxygenInput.value);

        if (oxygenValue < 95) {
            arrow_up_oxygen.style.display = 'none';
            arrow_down_oxygen.style.display = 'contents';
        } else if (oxygenValue > 100) {
            arrow_up_oxygen.style.display = 'contents';
            arrow_down_oxygen.style.display = 'none';
        } else {
            arrow_up_oxygen.style.display = 'none';
            arrow_down_oxygen.style.display = 'none';
        }
    }
</script>

<!-- Restriction and Arrow determination of Respiratory Rate -->
<script>
    const respiratoryRateInput = document.getElementById('respiratory_rate');
    const arrow_up_respiratory_rate = document.getElementById('arrow_up_respiratory_rate');
    const arrow_down_respiratory_rate = document.getElementById('arrow_down_respiratory_rate');

    respiratoryRateInput.addEventListener('input', validateRespiratoryRate);

    function validateRespiratoryRate() {
        const respiratoryRateValue = parseFloat(respiratoryRateInput.value);

        if (respiratoryRateValue < 16) {
            arrow_up_respiratory_rate.style.display = 'none';
            arrow_down_respiratory_rate.style.display = 'contents';
        } else if (respiratoryRateValue > 24) {
            arrow_up_respiratory_rate.style.display = 'contents';
            arrow_down_respiratory_rate.style.display = 'none';
        } else {
            arrow_up_respiratory_rate.style.display = 'none';
            arrow_down_respiratory_rate.style.display = 'none';
        }
    }
</script>

<!-- Restriction and Arrow determination of BP -->
<script>
    const bp1Input = document.getElementById('top_bp');
    const bp2Input = document.getElementById('bot_bp');
    const arrow_up_bp = document.getElementById('arrow_up_bp');
    const arrow_down_bp = document.getElementById('arrow_down_bp');

    bp1Input.addEventListener('input', validateBP);
    bp2Input.addEventListener('input', validateBP);

    function validateBP() {
        const bp1Value = parseFloat(bp1Input.value);
        const bp2Value = parseFloat(bp2Input.value);

        if (bp1Value <= bp2Value) {
            bp1Input.setCustomValidity("This area must be greater than hg");
            bp2Input.setCustomValidity("This area must be smaller than mm.");
        } else {
            bp1Input.setCustomValidity('');
            bp2Input.setCustomValidity('');
        }

        if (bp1Value < 90 && bp2Value < 60) {
            arrow_up_bp.style.display = 'none';
            arrow_down_bp.style.display = 'contents';
        } else if (bp1Value > 120 && bp2Value > 80) {
            arrow_up_bp.style.display = 'contents';
            arrow_down_bp.style.display = 'none';
        } else {
            arrow_up_bp.style.display = 'none';
            arrow_down_bp.style.display = 'none';
        }
    }
</script>

<!-- Restriction and Arrow determination of Temperature -->
<script>
    const temperatureInput = document.getElementById('temperature');
    const arrow_up_temperature = document.getElementById('arrow_up_temperature');
    const arrow_down_temperature = document.getElementById('arrow_down_temperature');

    temperatureInput.addEventListener('input', validateTemperature);

    function validateTemperature() {
        const temperatureValue = parseFloat(temperatureInput.value);

        if (temperatureValue < 36.5) {
            arrow_up_temperature.style.display = 'none';
            arrow_down_temperature.style.display = 'contents';
        } else if (temperatureValue > 37.5) {
            arrow_up_temperature.style.display = 'contents';
            arrow_down_temperature.style.display = 'none';
        } else {
            arrow_up_temperature.style.display = 'none';
            arrow_down_temperature.style.display = 'none';
        }
    }
</script>
@stop