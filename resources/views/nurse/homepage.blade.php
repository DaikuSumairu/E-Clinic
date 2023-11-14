@extends('adminlte::page')

<!-- Added PHP where detects if the date recorded from $daily_visits is for today -->
@php
    $todayRecords = $daily_visits->filter(function ($daily_visit) {
        return $daily_visit->date->isToday();
    });
@endphp
<!-- Tabs Title -->
@section('title', 'Homepage')

<!-- Content Header -->
@section('content_header')
    <h1>Daily Visits</h1>
@stop

<!-- Content Body -->
@section('content')
<div class="container-xxl border mb-2 record-customize-container-height-daily">
    <!-- Form Row -->
    <form method="POST" action="{{ route('nurse.dailyStore') }}" onsubmit="return confirm('Are you sure you want to record this visit?');">
        @csrf
        <div class="row row-cols-1 border">
            <!-- General Information Row -->
            <div class="col">
                <div class="row mb-1"> 
                    <!-- Patient Name -->
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" id="daily_name" name="daily_name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div> 

                    <!-- ID -->
                    <div class="col">
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="inputGroup-sizing-default">Student ID</span>
                            <input type="text" class="form-control-plaintext px-2" id="daily_id" name="daily_id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="col-2">
                        <div class="input-group mb-1">
                            <span class="input-group-text mr-2" id="inputGroup-sizing-default"><i class="far fa-calendar"></i></span>
                            <input type="date" class="form-control-plaintext" id="current_date" name="date" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
                        </div>
                    </div>

                    <!-- Time -->
                    <div class="col-2">
                        <input type="time" class="form-control-plaintext" id="current_time" name="time" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
                    </div>
                </div> 
            </div> 

            <!-- Dropdown connect to the Name -->
            <ul class="customize-name-dropdown border px-2" id="name_dropdown"></ul> 

            <!-- Second Row -->
            <div class="row row-cols-1 border">
                <!-- Complaint Row -->
                <div class="col">
                    <div class="row"> 
                        <!-- Main Complaint -->
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="main_compliant" required>Main Complaint</label>
                                <select class="form-control" name="main_complaint" id="main_compliant">
                                    <option selected hidden disbaled>Choose...</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Pulmonology">Pulmonology</option>
                                    <option value="Gastroenterology">Gastroenterology</option>
                                    <option value="Musculo Skeletal">Musculo Skeletal</option>
                                    <option value="Opthalmology">Opthalmology</option>
                                    <option value="ENT">ENT</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Nephrology">Nephrology</option>
                                    <option value="Endocrinology">Endocrinology</option>
                                    <option value="OB-Gyne">OB-Gyne</option>
                                    <option value="Hematologic">Hematologic</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Allergology">Allergology</option>
                                </select>
                            </div>
                        </div>  

                        <!-- Sub Complaint -->
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="sub_complaint" required>Sub Complaint</label>
                                <select class="form-control" name="sub_complaint" id="sub_complaint">
                                    <option selected hidden disbaled>Choose...</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
            <!-- Third Row -->
            <div class="col">
                <!-- Treatment Row -->
                <div class="input-group">
                    <span class="input-group-text">Treatment Notes</span>
                    <textarea class="form-control" name="treatment" aria-label="Treatment Notes" required></textarea>
                </div>
            </div> 
            
            <!-- Medicibe and Submit -->
            <div class="col">
                <div class="row">
                    <!-- Medicine -->
                    <div class="col-2 px-3 my-2">
                        <input type="checkbox" class="customize-checkbox-label" id="medicine" name="medicine" onclick="toggleTake('medicine')" value="Yes">
                        <label class="h4">Take Medicine?</label>
                    </div>

                    <!-- If medicine is checked show this -->
                    <div class="col-3 px-3 my-2" id="medicine_take_cols" style="display: none;">
                        <label class="h4">How many?</label>
                        <input type="number" class="customize-input-number" id="medicine_take" name="medicine_take" oninput="updateMedicineInputs()">
                    </div>
                    
                    <!-- add input on what medicine and taken depends on value requested -->
                    <div class="col px-3 my-2" id="medicine_take_type" style="max-height: 150px; overflow-y: auto;"></div>

                    <div class="col text-right px-3 my-2" style="width: 75px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Daily Visits Log -->
<div class="container-xxl border mt-2 record-customize-container-height-visit">
    <h1 class="text-center">Visits for the Day</h1>
    <div>
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Complainant Name</th>
                <th scope="col">ID Number</th>
                <th scope="col">Time of Visit</th>
            </tr>
            </thead>
            <tbody>
            @if($todayRecords->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">
                        <h2>No visit record has been made today</h2>
                    </td>
                </tr>
            @elseif($daily_visits->isNotEmpty())
                @foreach($daily_visits as $daily_visit)
                    @if($daily_visit->date->isToday())
                        <tr>
                            <td>{{ $daily_visit->daily_name }}</td>
                            @if($daily_visit->daily_id)
                                <td>{{ $daily_visit->daily_id }}</td>
                            @else
                                <td><p>Outside of the Facility</p></td>
                            @endif
                            <td>{{ $daily_visit->date->format('F d, Y') }} - {{ $daily_visit->time->format('h:i A') }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
@stop

<!-- CSS -->
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <!-- ZomProj css -->
    <link rel="stylesheet" href="{{ asset('assets/css/zomproj-record-daily.css') }}">
@stop

<!-- JavaScript -->
@section('js')
<!-- JQuery CDN (Content Delivery Network) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap package -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Get Current Date and Time Live -->
<script>
    $(document).ready(function(){
        // Function to update date and time
        function updateDateTime() {
            const date = new Date();

            // Update Date
            var currentDate = document.getElementById("current_date");
            // Format the date as ISO string and extract the date part
            var formattedDate = date.toISOString().split('T')[0];
            // Set the value of the 'current_date' input field
            currentDate.value = formattedDate;

            // Update Time
            var currentTime = document.getElementById("current_time");
            // Format the time as a string and extract the time part
            var formattedTime = date.toTimeString().split(' ')[0];
            // Set the value of the 'current_time' input field
            currentTime.value = formattedTime;
        }

        // Update every second (1000 milliseconds)
        setInterval(updateDateTime, 1000);

        // Initial update when the document is ready
        updateDateTime();
    });
</script>

<!-- Change option of sub complaint -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var main_compliant = document.getElementById('main_compliant');

        main_compliant.addEventListener('change', function(){
            var selectedMainOption = $(this).find(':selected');
            var selectedMainID = selectedMainOption.val();
            var subComplaintSelect = $('#sub_complaint');

            if (selectedMainID == 'Cardiology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Hypertension">Hypertension</option>');
                subComplaintSelect.append('<option value="BP Monitoring">BP Monitoring</option>');
                subComplaintSelect.append('<option value="Bradycardia">Bradycardia</option>');
                subComplaintSelect.append('<option value="Hypotension">Hypotension</option>');
            } else if (selectedMainID == 'Pulmonology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="URTI">URTI</option>');
                subComplaintSelect.append('<option value="Pneumonia">Pneumonia</option>');
                subComplaintSelect.append('<option value="PTB">PTB</option>');
                subComplaintSelect.append('<option value="Bronchitis">Bronchitis</option>');
                subComplaintSelect.append('<option value="Lung Pathology">Lung Pathology</option>');
                subComplaintSelect.append('<option value="Acute Bronchitis">Acute Bronchitis</option>');
            } else if (selectedMainID == 'Gastroenterology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Acute Gastroenteritis">Acute Gastroenteritis</option>');
                subComplaintSelect.append('<option value="GERD">GERD</option>');
                subComplaintSelect.append('<option value="Hemorrhoids">Hemorrhoids</option>');
                subComplaintSelect.append('<option value="Anorexia">Anorexia</option>');
            } else if (selectedMainID == 'Musculo Skeletal'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Ligament Sprain">Ligament Sprain</option>');
                subComplaintSelect.append('<option value="Muscle Sprain">Muscle Sprain</option>');
                subComplaintSelect.append('<option value="Costochondritis">Costochondritis</option>');
                subComplaintSelect.append('<option value="Soft Tissue Contusion">Soft Tissue Contusion</option>');
                subComplaintSelect.append('<option value="Fracture">Fracture</option>');
                subComplaintSelect.append('<option value="Gouty Arthritis">Gouty Arthritis</option>');
                subComplaintSelect.append('<option value="Plantar Fascitis">Plantar Fascitis</option>');
                subComplaintSelect.append('<option value="Dislocation">Dislocation</option>');
            } else if (selectedMainID == 'Opthalmology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Conjunctivitis">Conjunctivitis</option>');
                subComplaintSelect.append('<option value="Stye">Stye</option>');
                subComplaintSelect.append('<option value="Foreign Body">Foreign Body</option>');
            } else if (selectedMainID == 'ENT'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Stomatitis">Stomatitis</option>');
                subComplaintSelect.append('<option value="Epitaxis">Epitaxis</option>');
                subComplaintSelect.append('<option value="Otitis Media">Otitis Media</option>');
                subComplaintSelect.append('<option value="Foreign Body Removal">Foreign Body Removal</option>');
            } else if (selectedMainID == 'Neurology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Tension Headache">Tension Headache</option>');
                subComplaintSelect.append('<option value="Migraine">Migraine</option>');
                subComplaintSelect.append('<option value="Vertigo">Vertigo</option>');
                subComplaintSelect.append('<option value="Hyperventilation Syndrome">Hyperventilation Syndrome</option>');
                subComplaintSelect.append('<option value="Insomai">Insomai</option>');
                subComplaintSelect.append('<option value="Seizure">Seizure</option>');
                subComplaintSelect.append("<option value='Bell's Palsy'>Bell's Palsy</option>");
            } else if (selectedMainID == 'Dermatology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Folliculitis">Folliculitis</option>');
                subComplaintSelect.append('<option value="Carburncle">Carburncle</option>');
                subComplaintSelect.append('<option value="Burn">Burn</option>');
                subComplaintSelect.append('<option value="Wound Dressing">Wound Dressing</option>');
                subComplaintSelect.append('<option value="Infected Wound">Infected Wound</option>');
                subComplaintSelect.append('<option value="Blister Wound">Blister Wound</option>');
                subComplaintSelect.append('<option value="Seborrheic Dermatitis">Seborrheic Dermatitis</option>');
                subComplaintSelect.append('<option value="Bruise/Hermatoma">Bruise/Hermatoma</option>');
            } else if (selectedMainID == 'Nephrology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Urinary Tract Infection">Urinary Tract Infection</option>');
                subComplaintSelect.append('<option value="Renal Disease">Renal Disease</option>');
                subComplaintSelect.append('<option value="Urolithiasis">Urolithiasis</option>');
            } else if (selectedMainID == 'Endocrinology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Hypoglycemia">Hypoglycemia</option>');
                subComplaintSelect.append('<option value="Dyslipidemia">Dyslipidemia</option>');
                subComplaintSelect.append('<option value="Diabetes Mellitus">Diabetes Mellitus</option>');
            } else if (selectedMainID == 'OB-Gyne'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Dysmenorrhea">Dysmenorrhea</option>');
                subComplaintSelect.append('<option value="Hormonal Imbalance">Hormonal Imbalance</option>');
                subComplaintSelect.append('<option value="Pregnancy">Pregnancy</option>');
            } else if (selectedMainID == 'Hematologic'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Leukemia">Leukemia</option>');
                subComplaintSelect.append('<option value="Blood Dyscrasia">Blood Dyscrasia</option>');
                subComplaintSelect.append('<option value="Anemia">Anemia</option>');
            } else if (selectedMainID == 'Surgery'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Lacerated Wound">Lacerated Wound</option>');
                subComplaintSelect.append('<option value="Punctured Wound">Punctured Wound</option>');
                subComplaintSelect.append('<option value="Animal Bite">Animal Bite</option>');
                subComplaintSelect.append('<option value="Superficail Abrasions">Superficail Abrasions</option>');
                subComplaintSelect.append('<option value="Foreign Body Removal">Foreign Body Removal</option>');
            } else if (selectedMainID == 'Allergology'){
                subComplaintSelect.empty();
                subComplaintSelect.append('<option value="Contact Dermatitis">Contact Dermatitis</option>');
                subComplaintSelect.append('<option value="Allergic Rhinitis">Allergic Rhinitis</option>');
                subComplaintSelect.append('<option value="Bronchial Asthma">Bronchial Asthma</option>');
                subComplaintSelect.append('<option value="Hypersensitivity">Hypersensitivity</option>');
            }
        });
    });
</script>

<!-- Dropdown live search for User Name -->
<script type="text/javascript">
    // This script listens for user input in the 'search' input field and triggers an action when a key is released.
    $('#daily_name').on('keyup', function(){
        // Get the value entered by the user.
        $value=$(this).val();

        // default will be change into search if it has value
        if($value){
            $('#name_dropdown').show();
            $('#daily_id').val('');
        } else {
            $('#name_dropdown').hide();            
            $('#daily_id').val('');
        }

        // Send an AJAX GET request to the server to perform a search using the user's input.
        $.ajax({
            type:'get',
            // Define the URL for the search request (likely configured in a Laravel route).
            url:'{{ route('nurse.dailyName') }}',
            // Send the user's input as search data.
            data:{'name' : $value},

            // When the server responds successfully, update the page with the received data.
            success:function(data){
                // Replace the HTML content of an element with id 'name_dropdown' with the new data.
                $('#name_dropdown').html(data);

                // Add a click event listener to the dropdown names
                $('.dropdown-names').click(function(){
                    // Set the daily_name input value to the clicked name
                    $('#daily_name').val($(this).data('fill_name'));
                    // Set the daily_id input value to the clicked ID
                    $('#daily_id').val($(this).data('fill_id'));
                    // Hide the dropdown after selection
                    $('#name_dropdown').hide();
                });
            }
        });
    });
</script>

<!-- Checkbox -->
<script>
    function toggleTake(checkboxId) {
        var count_cols = document.getElementById(checkboxId + "_take_cols");
        var count = document.getElementById(checkboxId + "_take");
        var med_type = document.getElementById(checkboxId + "_take_type");
        var checkbox = document.getElementById(checkboxId);
        count.required = checkbox.checked;
        if (!checkbox.checked) {
            count.value = ""; // Clear input text
            checkbox.value = "No"; // Set checkbox value to "No"
            count_cols.style.display = 'none'; // Hide the associated element
            count.required = false;
        }else{
            count.value = ""; // Clear input text
            checkbox.value = "Yes"; // Set checkbox value to "Yes"
            count_cols.style.display = 'block'; // Show the associated element
        }
    }
</script>

<!-- JavaScript to dynamically add inputs -->
<script type="text/javascript">
    function updateMedicineInputs() {
        var medicineTakeValue = document.getElementById("medicine_take").value;
        var medicineTakeTypeDiv = document.getElementById("medicine_take_type");

        // Clear existing content
        medicineTakeTypeDiv.innerHTML = "";

        // Add new inputs based on medicineTakeValue
        for (var i = 1; i <= medicineTakeValue; i++) {
            // Create a container for each set of inputs
            var container = document.createElement("div");

            container.innerHTML = `
                <label for="medicine_name_${i}">Name of the Medicine take:</label> 
                <span id="quantity_med_${i}"></span> 
                <select name="medicine_name[]" id="medicine_name_${i}" onchange="showQuantity(${i})" style="width: 175px;" required>
                    <option hidden disabled selected>Choose Medicine</option>
                    @foreach($inventory_infos as $inventory_info)
                        <option value="{{ $inventory_info->name }}" data-id="{{ $inventory_info->id }}">{{ $inventory_info->name }}</option>
                    @endforeach
                </select>
                = 
                <input type="number" class="customize-input-number" id="med_quantity_${i}" name="reduce_quantity[]" placeholder="Take" required><br>
                <textarea id="taking_${i}" name="take[]" class="recording_meds" hidden></textarea>
            `;

            medicineTakeTypeDiv.appendChild(container);
        }
    }

    function showQuantity(i) {
        var selectedMed = document.getElementById('medicine_name_' + i);
        var inputQuant = document.getElementById('med_quantity_' + i);
        var selectedQuantity = document.getElementById('quantity_med_' + i);
        var filling = document.getElementById('taking_' + i);

        // Bind 'input' event for live updates
        $(inputQuant).on('input', function () {
            filling.value = i +'. Medicine: ' + selectedMed.value + ' Take: ' + inputQuant.value;
        });

        if (selectedMed) {
            filling.value = i +'. Medicine: ' + selectedMed.value + ' Take: ' + inputQuant.value;
        }

        // Send an AJAX GET request to the server to perform a search using the user's input.
        $.ajax({
            type: 'get',
            // Define the URL for the search request (likely configured in a Laravel route).
            url: '{{ route('nurse.dailyUsed') }}',
            // Send the user's input as search data.
            data: { 'medicine_name': selectedMed.value },

            // When the server responds successfully, update the page with the received data.
            success: function (data) {
                // Replace the HTML content of an element with id 'quantity_med_' + i with the new data.
                selectedQuantity.innerHTML = data;
            }
        });
    }
</script>
@stop