@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Health Record')

<!-- Content Header -->
@section('content_header')
    <h1>List of Patient's Health Record</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Body -->
<div class="container-xxl mb-2 record-customize-container-height">
    <!-- Add and Search Item -->
    <div class="row">
        <!-- Search Item -->
        <div class="col">
            <div class="row">
                <div class="col">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search Patient's Name">
                </div>
                <button type="button" class="btn btn-primary" style="cursor: auto;" disabled><span class="fas fa-search "></span></button>
            </div>
        </div>
    </div>

    <!-- List table of Medicine and Equipment that have in record -->
    <div class="mt-3 customize-table-container">
        <table class="table">
            <!-- Header of the table -->
            <thead>
                <tr>
                    <th class="th-position">Patient Name</th>
                    <th class="th-position">ID</th>
                    <th class="th-position">Course / Specialization</th>
                    <th class="th-position">Grade / Year</th>
                    <th class="th-position">Section</th>
                    <th class="th-position">Roles</th>
                    <th class="th-position" style="text-align: center;">Option</th>
                </tr>
            </thead>
            <!-- Default body of the table -->
            <tbody class="record-content-default">
                <!-- Showing all items in the record table and each item will be called as "recordItem" -->
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->school_id }}</td>
                    <!-- If user has 'course' or 'specialization' -->
                    <td>
                        @if($user->course ?: $user->specialization)
                        {{ $user->course ?: $user->specialization }}
                        @else
                        Not Applicable
                        @endif
                    </td>
                    <!-- If user has 'grade' or 'year' -->
                    <td>
                        @if($user->grade ?: $user->year)
                        {{ $user->grade ?: $user->year }}
                        @else
                        Not Applicable
                        @endif
                    </td>
                    <!-- If user has 'section' -->
                    <td>
                        @if($user->section)
                        {{ $user->section }}
                        @else
                        Not Applicable
                        @endif
                    </td>
                    <td>{{ $user->role->role }}</td>
                    <!-- Show Patient's Record -->
                    <td class="text-center">
                    @if($records->where('user_id', $user->id)->isEmpty())
                    <a href="{{ route('nurse.recordCreate', $user->id) }}" class="btn btn-success">Create Patient's Health Record</a>
                    @else
                    <a href="{{ route('nurse.recordShow', $user->record->id) }}" class="btn btn-info">Show Patient's Health Record</a>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

            <!-- Search body of the table -->
            <tbody id="record-content" class="record-content-search">
            </tbody>
        </table>
    </div>
</div>
{!! $users->links('zomproj.customize-pagination', ['paginator' => $users]) !!}
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

<!-- Live Search on table -->
<script type="text/javascript">
    // This script listens for user input in the 'search' input field and triggers an action when a key is released.
    $('#search').on('keyup', function(){
        // Get the value entered by the user.
        $value=$(this).val();

        // default will be change into search if it has value
        if($value){
            $('.record-content-default').hide();
            $('.record-content-search').show();
        }else{
            $('.record-content-default').show();
            $('.record-content-search').hide();            
        }

        // Send an AJAX GET request to the server to perform a search using the user's input.
        $.ajax({
            type:'get',
            // Define the URL for the search request (likely configured in a Laravel route).
            url:'{{ route('nurse.recordSearch') }}',
            // Send the user's input as search data.
            data:{'search':$value},

            // When the server responds successfully, update the page with the received data.
            success:function(data){
                // Replace the HTML content of an element with id 'Content' with the new data.
                $('#record-content').html(data)
            }
        });
    });
</script>
@stop