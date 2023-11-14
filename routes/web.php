<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicalExamController;
use App\Http\Controllers\DentalExamController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//On open, redirect to login page 
Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', function(){
    return view('auth.login');
});

Auth::routes();

//No Role
Route::middleware(['auth', 'role:No Role'])->group(function () {
    //homepage
    Route::get('/home', [HomeController::class, 'noRoleHome'])->name('noRoleHome');
});

//Student
Route::middleware(['auth', 'role:Student'])->group(function () {
    // record /////////////////////////////////////////////////////////////////////////////////////
    Route::resource('/student/record', RecordController::class)->names([
        'index' => 'student.recordIndex',
    ])->except([
       'search', 'show', 'create', 'store', 'edit', 'update', 'delete'
    ]);
        
    // record (Consultation part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/student/record/{record}/consultation/', [ConsultationController::class, 'date'])
        ->name('student.consultationDate');

    // record (Medical Exam part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/student/record/{record}/medical-exam/', [MedicalExamController::class, 'date'])
        ->name('student.medicalExamDate');

    // record (Dental Exam part) (Extra) //////////////////////////////////////////////////////////
    Route::get('/student/record/{record}/dental-exam/', [DentalExamController::class, 'date'])
        ->name('student.dentalExamDate');
});

//Faculty
Route::middleware(['auth', 'role:Faculty'])->group(function () {
    // record /////////////////////////////////////////////////////////////////////////////////////
    Route::resource('/faculty/record', RecordController::class)->names([
        'index' => 'faculty.recordIndex',
    ])->except([
       'search', 'show', 'create', 'store', 'edit', 'update', 'delete'
    ]);
        
    // record (Consultation part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/faculty/record/{record}/consultation/', [ConsultationController::class, 'date'])
        ->name('faculty.consultationDate');

    // record (Medical Exam part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/faculty/record/{record}/medical-exam/', [MedicalExamController::class, 'date'])
        ->name('faculty.medicalExamDate');

    // record (Dental Exam part) (Extra) //////////////////////////////////////////////////////////
    Route::get('/faculty/record/{record}/dental-exam/', [DentalExamController::class, 'date'])
        ->name('faculty.dentalExamDate');
});

//Staff
Route::middleware(['auth', 'role:Staff'])->group(function () {
    // record /////////////////////////////////////////////////////////////////////////////////////
    Route::resource('/staff/record', RecordController::class)->names([
        'index' => 'staff.recordIndex',
    ])->except([
       'search', 'show', 'create', 'store', 'edit', 'update', 'delete'
    ]);
        
    // record (Consultation part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/staff/record/{record}/consultation/', [ConsultationController::class, 'date'])
        ->name('staff.consultationDate');

    // record (Medical Exam part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/staff/record/{record}/medical-exam/', [MedicalExamController::class, 'date'])
        ->name('staff.medicalExamDate');

    // record (Dental Exam part) (Extra) //////////////////////////////////////////////////////////
    Route::get('/staff/record/{record}/dental-exam/', [DentalExamController::class, 'date'])
        ->name('staff.dentalExamDate');
});

//Nurse
Route::middleware(['auth', 'role:Nurse'])->group(function () {
    //homepage
    Route::resource('/nurse/daily-visit', DailyController::class)->names([
        'index' => 'nurse.dailyIndex',
        'store' => 'nurse.dailyStore',
    ])->except([
        'show', 'edit', 'update', 'delete'
    ]);

    // homepage (Extra)
    Route::get('/record/daily-visit/search', [DailyController::class, 'name'])
        ->name('nurse.dailyName');
    Route::get('/record/daily-visit/take', [DailyController::class, 'used'])
        ->name('nurse.dailyUsed');

    // record //////////////////////////////////////////////////////////////////////////////////////
    Route::resource('/nurse/record', RecordController::class)->names([
        'index' => 'nurse.recordIndex',
        'store' => 'nurse.recordStore',
        'show' => 'nurse.recordShow',
        'edit' => 'nurse.recordEdit',
        'update' => 'nurse.recordUpdate',
    ])->except([
        'create', 'delete'
    ]);
    
    // record alternatives
    Route::get('/nurse/record/create/{user}', [RecordController::class, 'create'])
        ->name('nurse.recordCreate');

    // record (Extra)
    Route::get('/record/search', [RecordController::class, 'search'])
        ->name('nurse.recordSearch');
        
    // record (Consultation part) //////////////////////////////////////////////////////////////////
    Route::resource('nurse/record/consultation', ConsultationController::class)->names([
        'store' => 'nurse.consultationStore',
        'edit' => 'nurse.consultationEdit',
        'update' => 'nurse.consultationUpdate',
    ])->except([
        'index', 'create', 'delete'
    ]);

    // record (Consultation part) (Extra)
    Route::get('/nurse/record/{record}/consultation/', [ConsultationController::class, 'date'])
        ->name('nurse.consultationDate');
    
    // record (Consultation part) (Alternatives)
    Route::get('/nurse/record/consultation/create/{record}', [ConsultationController::class, 'create'])
        ->name('nurse.consultationCreate');

    // record (Medical Exam part) //////////////////////////////////////////////////////////////////
    Route::resource('nurse/record/medical-exam', MedicalExamController::class)->names([
        'store' => 'nurse.medicalExamStore',
        'edit' => 'nurse.medicalExamEdit',
        'update' => 'nurse.medicalExamUpdate',
    ])->except([
        'index', 'create', 'delete'
    ]);

    // record (Medical Exam part) (Extra)
    Route::get('/nurse/record/{record}/medical-exam/', [MedicalExamController::class, 'date'])
        ->name('nurse.medicalExamDate');

    // record (Medical Exam part) (Alternatives)
    Route::get('/nurse/record/medical-exam/create/{record}', [MedicalExamController::class, 'create'])
        ->name('nurse.medicalExamCreate');

    // record (Dental Exam part) (Extra) ///////////////////////////////////////////////////////////
    Route::get('/nurse/record/{record}/dental-exam/', [DentalExamController::class, 'date'])
        ->name('nurse.dentalExamDate');

    // inventory ///////////////////////////////////////////////////////////////////////////////////
    Route::resource('/nurse/inventory', InventoryController::class)->names([
        'index' => 'nurse.inventoryIndex',
        'store' => 'nurse.inventoryStore',
    ])->except([
        'show', 'create', 'edit', 'update', 'delete'
    ]);;

    // inventory alternatives
    Route::put('/nurse/inventory/{inventoryItem}', [InventoryController::class, 'update'])
        ->name('nurse.inventoryUpdate');

    // inventory (Update Extra)
    Route::put('/nurse/inventory/{inventoryItem}/add', [InventoryController::class, 'add'])
        ->name('nurse.inventoryAdd');
    Route::put('/nurse/inventory/{inventoryItem}/reduce', [InventoryController::class, 'reduce'])
        ->name('nurse.inventoryReduce');
    
    // inventory (Extra)
    Route::get('/inventory/search', [InventoryController::class, 'search'])
        ->name('nurse.inventorySearch');
});

//Doctor
Route::middleware(['auth', 'role:Doctor'])->group(function () {
    // record //////////////////////////////////////////////////////////////////////////////////////
    Route::resource('/doctor/record', RecordController::class)->names([
        'index' => 'doctor.recordIndex',
        'show' => 'doctor.recordShow',
    ])->except([
        'create', 'store', 'edit', 'update', 'delete'
    ]);

    // record (Extra)
    Route::get('/record/search', [RecordController::class, 'search'])
    ->name('nurse.recordSearch');
        
    // record (Consultation part) //////////////////////////////////////////////////////////////////
    Route::resource('doctor/record/consultation', ConsultationController::class)->names([
        'store' => 'doctor.consultationStore',
        'edit' => 'doctor.consultationEdit',
        'update' => 'doctor.consultationUpdate',
    ])->except([
        'index', 'create', 'delete'
    ]);

    // record (Consultation part) (Extra)
    Route::get('/doctor/record/{record}/consultation/', [ConsultationController::class, 'date'])
        ->name('doctor.consultationDate');
    
    // record (Consultation part) (Alternatives)
    Route::get('/doctor/record/consultation/create/{record}', [ConsultationController::class, 'create'])
        ->name('doctor.consultationCreate');

    // record (Medical Exam part) //////////////////////////////////////////////////////////////////
    Route::resource('doctor/record/medical-exam', MedicalExamController::class)->names([
        'store' => 'doctor.medicalExamStore',
        'edit' => 'doctor.medicalExamEdit',
        'update' => 'doctor.medicalExamUpdate',
    ])->except([
        'index', 'create', 'delete'
    ]);

    // record (Medical Exam part) (Extra)
    Route::get('/doctor/record/{record}/medical-exam/', [MedicalExamController::class, 'date'])
        ->name('doctor.medicalExamDate');

    // record (Medical Exam part) (Alternatives)
    Route::get('/doctor/record/medical-exam/create/{record}', [MedicalExamController::class, 'create'])
        ->name('doctor.medicalExamCreate');

    // record (Dental Exam part) (Extra) ///////////////////////////////////////////////////////////
    Route::get('/doctor/record/{record}/dental-exam/', [DentalExamController::class, 'date'])
        ->name('doctor.dentalExamDate');
});

//Dentist
Route::middleware(['auth', 'role:Dentist'])->group(function () {
    // record //////////////////////////////////////////////////////////////////////////////////////
    Route::resource('/dentist/record', RecordController::class)->names([
        'index' => 'dentist.recordIndex',
        'show' => 'dentist.recordShow',
    ])->except([
        'create', 'store', 'edit', 'update', 'delete'
    ]);

    // record (Extra)
    Route::get('/record/search', [RecordController::class, 'search'])
    ->name('nurse.recordSearch');
        
    // record (Consultation part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/dentist/record/{record}/consultation/', [ConsultationController::class, 'date'])
        ->name('dentist.consultationDate');

    // record (Medical Exam part) (Extra) /////////////////////////////////////////////////////////
    Route::get('/dentist/record/{record}/medical-exam/', [MedicalExamController::class, 'date'])
        ->name('dentist.medicalExamDate');

    // record (Dental Exam part) //////////////////////////////////////////////////////////////////
    Route::resource('dentist/record/dental-exam', DentalExamController::class)->names([
        'store' => 'dentist.dentalExamStore',
        'edit' => 'dentist.dentalExamEdit',
        'update' => 'dentist.dentalExamUpdate',
    ])->except([
        'index', 'create', 'delete'
    ]);

    // record (Dental Exam part) (Extra)
    Route::get('/dentist/record/{record}/dental-exam/', [DentalExamController::class, 'date'])
        ->name('dentist.dentalExamDate');

    // record (Dental Exam part) (Alternatives)
    Route::get('/dentist/record/dental-exam/create/{record}', [DentalExamController::class, 'create'])
        ->name('dentist.dentalExamCreate');
});

//Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    //homepage
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('adminHome');
});