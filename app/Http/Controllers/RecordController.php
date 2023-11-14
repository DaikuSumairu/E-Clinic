<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Live Search on Table
     */
    public function search(Request $request)
    {
        $output = "";
        $users = User::where('name', 'LIKE', '%'.$request->search.'%')
            ->whereNotIn('role_id', [5, 6, 7, 8])
            ->get();
        $records = Record::get();

        foreach($users as $user)
        {
            $output.='<tr>
            <td>'. $user->name.'</td>
            <td>'. $user->school_id .'</td>';
            
            // if patient has course or specialization
            if($user->course || $user->specialization){
                $output.='<td>'. $user->course ?: $user->specialization .'</td>';
            } else {
                $output.='<td>Not Applicable</td>';
            }

            // if patient has grade or year
            if($user->grade || $user->year){
                $output.='<td>'. $user->grade ?: $user->year .'</td>';
            } else {
                $output.='<td>Not Applicable</td>';
            }

            // if patient has section
            if($user->section){
                $output.='<td>'. $user->sectiuon .'</td>';
            } else {
                $output.='<td>Not Applicable</td>';
            }
            
            $output.='<td>'. $user->role->role .'</td>
            <td>';
            if($records->where('user_id', $user->id)->isEmpty()){
                if(auth()->user()->role->role === 'Nurse'){
                    $output.="<a href='". route("nurse.recordCreate", $user->id) ."' class='btn btn-success'>Create Patient's Health Record</a>";
                } else {
                    $output.="<label>This patient has no record yet</label>";
                }
            } else {
                $output.="<a href='". route("nurse.recordShow", $user->record->id) ."' class='btn btn-info'>Show Patient's Health Record</a>";
            }

            $output.='</td></tr>';
        }

        return response($output);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNotIn('role_id', [5, 6, 7, 8])
            ->orderBy('name', 'asc')
            ->paginate(10);
        $records = Record::get();

        if(auth()->user()->role->role == 'Nurse')
        {
            return view('nurse.record.record-home',compact('users', 'records',))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        elseif(auth()->user()->role->role == 'Student')
        {
            $record = Record::where('user_id', '=', auth()->user()->id)->first();
            return view('student.record.record-show', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Faculty')
        {
            $record = Record::where('user_id', '=', auth()->user()->id)->first();
            return view('faculty.record.record-show', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Staff')
        {
            $record = Record::where('user_id', '=', auth()->user()->id)->first();
            return view('faculty.record.record-show', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return view('doctor.record.record-home',compact('users', 'records',))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        elseif(auth()->user()->role->role == 'Dentist')
        {
            return view('dentist.record.record-home',compact('users', 'records',))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('nurse.record.record-create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'integer',
            'birth_date' => 'required|date',
            'age' => 'integer',
            'sex' => 'in:Male,Female',
            'civil_status' => 'in:Single,Married,Divorced,Widowed',
            'address' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zip' => 'required|string',
            'mobile_number' => 'required|regex:/^09\d{9}$/',
            'contact_person' => 'required|string',
            'contact_person_number' => 'required|regex:/^09\d{9}$/',
        ], [
            'mobile_number.regex' => 'The input for mobile number must contain \'09\' at the start.',
            'contact_person_number.regex' => 'The input for contact person number must contain \'09\' at the start.',
        ]);

        Record::create($request->all());

        return redirect()->route('nurse.recordIndex')
            ->with('success', 'Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        if(auth()->user()->role->role == 'Nurse')
        {
            return view('nurse.record.record-show', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Dentist')
        {
            return view('dentist.record.record-show', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return view('doctor.record.record-show', compact('record'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        return view('nurse.record.record-edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $request->validate([
            'user_id' => 'integer',
            'birth_date' => 'required|date',
            'age' => 'integer',
            'sex' => 'in:Male,Female',
            'civil_status' => 'in:Single,Married,Divorced,Widowed',
            'address' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zip' => 'required|string',
            'mobile_number' => 'required|regex:/^09\d{9}$/',
            'contact_person' => 'required|string',
            'contact_person_number' => 'required|regex:/^09\d{9}$/',
        ], [
            'mobile_number.regex' => 'The input for mobile number must contain \'09\' at the start.',
            'contact_person_number.regex' => 'The input for contact person number must contain \'09\' at the start.',
        ]);

        $record->update($request->all());

        return redirect()->route('nurse.recordShow', $record->id)
            ->with('success', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
