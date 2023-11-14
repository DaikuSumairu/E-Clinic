<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //No Role
    public function noRoleHome()
    {
        return view('no-role.homepage');
    }

    //Student
    public function studentHome()
    {
        return view('student.homepage');
    }

    //Faculty
    public function facultyHome()
    {
        return view('faculty.homepage');
    }

    //Staff
    public function staffHome()
    {
        return view('staff.homepage');
    }

    //Clinic
    public function nurseHome()
    {
        return view('nurse.homepage');
    }

    //Doctor
    public function doctorHome()
    {
        return view('doctor.homepage');
    }

    //Dentist
    public function dentistHome()
    {
        return view('dentist.homepage');
    }

    //Admin
    public function adminHome()
    {
        return view('admin.homepage');
    }
}
