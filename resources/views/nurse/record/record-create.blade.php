@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Creating Health Record')

<!-- Content Header -->
@section('content_header')
    <h1>Creating New Record for {{ $user->name }}</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Go back from the last page -->
<a class="btn btn-danger mb-2" href="{{ route('nurse.recordIndex') }}">Go Back</a>

<!-- Body -->
<div class="container-xxl mb-2 record-customize-create-container-height">
    <form method="POST" action="{{ route('nurse.recordStore') }}" onsubmit="return confirm('Are the details for this patience are correct?');">
        @csrf
        <!-- Hidden value to be save on record -->
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <!-- 1st row -->
        <div class="row border border-3 record-create-width mx-auto py-3">
            <!-- Birthdate -->
            <div class="col">
                <div class="row">
                    <div class="col-sm-2 pt-2">
                        <label>Birthdate:</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" onchange="calculateAge()">
                        @error('birth_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Age -->
            <div class="col">
                <div class="row">
                    <div class="col-sm-1 pt-2">
                        <label>Age:</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control-plaintext" style="cursor: auto;" name="age" id="age" placeholder="0" value="{{ old('age') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 2nd row -->
        <div class="row border border-3 record-create-width mx-auto my-2 py-3">
            <!-- Sex -->
            <div class="col">
                <label>Sex:</label>
                <select class="form-control" name="sex" value="{{ old('sex') }}">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            
            <!-- Civil Status -->
            <div class="col">
                <label>Civil Status:</label>
                <select class="form-control" name="civil_status" value="{{ old('civil_status') }}">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Dirvorced">Dirvorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>
        </div>
        
        <!-- 3rd row -->
        <div class="row-col-1 border border-3 record-create-width mx-auto my-2 py-3">
            <!-- Address -->
            <div class="col">
                <label>Address:</label>
                <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col">
                <div class="row py-3">
                    <!-- Street -->
                    <div class="col">
                        <label>Street:</label>
                        <input type="text" class="form-control" name="street" value="{{ old('street') }}" required>
                        @error('street')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- City -->
                    <div class="col">
                        <label>City:</label>
                        <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                        @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row py-3">
                    <!-- Province -->
                    <div class="col">
                        <label>Province:</label>
                        <input type="text" class="form-control" name="province" value="{{ old('province') }}" required>
                        @error('province')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- ZIP/Postal Code -->
                    <div class="col">
                        <label>ZIP/Postal Code:</label>
                        <input type="text" class="form-control" name="zip" value="{{ old('zip') }}" required>
                        @error('zip')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 4th row -->
        <div class="row border border-3 record-create-width mx-auto my-2 py-3">
            <!-- Mobile Number -->
            <div class="col">
                <label>Mobile Number:</label>
                <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" pattern="[0-9]{11}" placeholder="09*********" required>
                @error('mobile_number')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Contact Person -->
            <div class="col">
                <label>Contact Person:</label>
                <input type="text" class="form-control" name="contact_person" value="{{ old('contact_person') }}" required>
                @error('contact_person')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contact Person Number -->
            <div class="col">
                <label>Contact Person Number:</label>
                <input type="text" class="form-control" name="contact_person_number" value="{{ old('contact_person_number') }}" pattern="[0-9]{11}" placeholder="09*********" required>
                @error('contact_person_number')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary float-right mt-2 mr-2">Create Record</button>
    </form>
</div>
@stop

<!-- CSS -->
@section('css')
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="/css/admin_custom.css">

    <!-- ZomProj css -->
    <link rel="stylesheet" href="{{ asset('assets/css/record/zomproj-record.css') }}">
@stop

<!-- JavaScript -->
@section('js')
<!-- JQuery CDN (Content Delivery Network) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap package -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Calculat Ag via Birth Date -->
<script>
    function calculateAge() {
        // Get the selected birth date
        var birthDate = new Date(document.getElementById("birth_date").value);

        // Get the current date
        var currentDate = new Date();

        // Calculate the difference in years
        var age = currentDate.getFullYear() - birthDate.getFullYear();

        // Check if the birthday has occurred this year
        if (
            currentDate.getMonth() < birthDate.getMonth() ||
            (currentDate.getMonth() === birthDate.getMonth() && currentDate.getDate() < birthDate.getDate())
        ) {
            age--;
        }

        // Set the calculated age to the age input field
        document.getElementById("age").value = age;
    }
</script>
@stop