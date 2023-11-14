<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationResponse;
use App\Models\Record;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function date(Request $request, Record $recordId)
    {
        $responseData = [
            'consultation_output' => '',
            'first_output' => '',
            'second_output' => '',
            'third_output' => '',
            'fourth_output' => '',
        ];

        $consultations = Consultation::where('id', $request->consultation_id)
            ->where(function ($query) use ($request) {
                $query->whereDate('date_created', $request->date)
                    ->orWhereDate('date_updated', $request->date)
                    ->orWhereDate('date_finished', $request->date)
                    ->orWhereNull('date_created')
                    ->orWhereNull('date_updated')
                    ->orWhereNull('date_finished');
            })
            ->get();

        if ($consultations) {
            foreach($consultations as $consultation){
                //Consultation Header
                if(auth()->user()->role->role == 'Nurse' || auth()->user()->role->role == 'Doctor'){
                    if(auth()->user()->role->role == 'Nurse'){
                        $responseData['consultation_output'].='<a class="info btn btn-primary mr-2" href="'. route('nurse.consultationCreate', $consultation->record->id ) .'">Create</a>';
                        if($consultation->consultation_response->remarks === "Monitoring Case"){
                            $responseData['consultation_output'].='<a class="info btn btn-info ml-2" href="'. route('nurse.consultationEdit', $consultation->id ) .'">Update</a>';
                        }
                    } else {
                        $responseData['consultation_output'].='<a class="info btn btn-primary mr-2" href="'. route('doctor.consultationCreate', $consultation->record->id ) .'">Create</a>';
                        if($consultation->consultation_response->remarks === "Monitoring Case"){
                            $responseData['consultation_output'].='<a class="info btn btn-info ml-2" href="'. route('doctor.consultationEdit', $consultation->id ) .'">Update</a>';
                        }
                    }
                }
                
                //First Row
                $responseData['first_output'].='<div class="col-sm-2">
                    <label class="info h1">Complaint:'. $consultation->consultation_response->complaint .'</label>
                </div>';

                //Second Row
                $responseData['second_output'].='<div class="col">
                    <label class="info h3">Vital Signs:</label>
                </div>
                
                <div class="col mb-1">
                    <div class="row mt-1 mx-auto">
                        <div class="col pb-2 border border-1">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label class="info">Pulse / Heart Rate:</label>
                                </div>
                                <div class="col text-center">
                                    <span class="info">'. $consultation->consultation_response->pulse .' BPM</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- O2 Stat -->
                        <div class="col pb-2 border border-1">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label class="info">O2 Stat:</label>
                                </div>
                                <div class="col text-center">
                                    <span class="info">'. $consultation->consultation_response->oxygen .' %</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Respiratory Rate -->
                        <div class="col pb-2 border border-1">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label class="info">Respiratory Rate:</label>
                                </div>
                                <div class="col text-center">
                                    <span class="info">'. $consultation->consultation_response->respiratory_rate .' BPM</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Blood Pressure -->
                        <div class="col pb-2 border border-1">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label class="info">Blood Pressure (mm/hg):</label>
                                </div>
                                <div class="col text-center">
                                    <span class="info">'. $consultation->consultation_response->top_bp .' / '. $consultation->consultation_response->bot_bp .'</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Temperature -->
                        <div class="col pb-2 border border-1">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <label class="info">Temperature:</label>
                                </div>
                                <div class="col text-center">
                                    <span class="info">'. $consultation->consultation_response->temperature .' °C</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

                //Third Row
                $responseData['third_output'].='<div class="col">
                    <label class="info h1">Treatment:</label>
                </div>
                <div class="col">
                    <textarea class="form-control-plaintext" name="treatment" rows="3" readonly>'. $consultation->consultation_response->treatment .'</textarea>
                </div>';

                //Fourth Row
                $responseData['fourth_output'].='<div class="col">';
                // if patient has grade or year
                if($consultation->consultation_response->remarks === "Monitoring Case"){
                    $responseData['fourth_output'].='<label class="info h1">Nurse Remark: <span class="info h1 text-warning">'. $consultation->consultation_response->remarks .'</span></label>';
                } else {
                    $responseData['fourth_output'].='<label class="info h1">Nurse Remark: <span class="info h1 text-success">'. $consultation->consultation_response->remarks .'</span></label>';
                }
                    
                $responseData['fourth_output'].='</div>';
            }
        }else {
            // Handle the case when no consultations are found
            return response('No consultations found', 404);
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
        if(auth()->user()->role->role == 'Nurse')
        {
            return view('nurse.record.consultation.record-consultation-create', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return view('doctor.record.consultation.record-consultation-create', compact('record'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Connect Consultation ID to that specific Record ID
        $recordID = $request->input('record_id');
        $consultationData = $request->all();
        $consultationData['record_id'] = $recordID;

        // Create Consultation
        $consultation = Consultation::create($consultationData);

        // Connect Consultation Response ID to the Consultation ID
        $request->validate([
            'complaint' => 'required|string',
            'pulse' => 'required|integer',
            'oxygen' => 'required|integer',
            'respiratory_rate' => 'required|integer',
            'top_bp' => 'required|integer',
            'bot_bp' => 'required|integer',
            'temperature' => 'required|numeric',
            'treatment' => 'required',
            'remarks' => 'in:Monitoring Case,Resolved Case',
        ]);

        $consultationID = $consultation->id;
        $consultationResponseData = $request->all();
        $consultationResponseData['consultation_id'] = $consultationID;

        // Create Consultation Response
        ConsultationResponse::create($consultationResponseData);
        
        if(auth()->user()->role->role == 'Nurse')
        {
            return redirect()->route('nurse.recordShow', ['record' => $recordID])->with('success', 'Consultation created successfully.');
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return redirect()->route('doctor.recordShow', ['record' => $recordID])->with('success', 'Consultation created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        if(auth()->user()->role->role == 'Nurse')
        {
            return view('nurse.record.consultation.record-consultation-edit', compact('consultation'));
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return view('doctor.record.consultation.record-consultation-edit', compact('consultation'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        
        // Connect Consultation Response ID to the Consultation ID
        $request->validate([
            'complaint' => 'required|string',
            'pulse' => 'required|integer',
            'oxygen' => 'required|integer',
            'respiratory_rate' => 'required|integer',
            'top_bp' => 'required|integer',
            'bot_bp' => 'required|integer',
            'temperature' => 'required|numeric',
            'treatment' => 'required',
            'remarks' => 'in:Monitoring Case,Resolved Case',
        ]);
        
        // Update Consultation and Consultation Response
        $consultation->update($request->all());
        $consultation->consultation_response->update($request->all());

        if(auth()->user()->role->role == 'Nurse')
        {
            return redirect()->route('nurse.recordShow', ['record' => $consultation->record->id ])->with('success', 'Consultation created successfully.');
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return redirect()->route('doctor.recordShow', ['record' => $consultation->record->id ])->with('success', 'Consultation created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
