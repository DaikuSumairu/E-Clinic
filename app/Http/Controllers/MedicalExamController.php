<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\MedicalExam;
use App\Models\PastMedicalHistory;
use App\Models\PastMedicalHistoryFinding;
use App\Models\FamilyHistory;
use App\Models\FamilyHistoryFinding;
use App\Models\PersonalSocial;
use App\Models\ObGyneReview;
use App\Models\ObGyneReviewFinding;
use App\Models\PhysicalExamination;
use App\Models\PhysicalExaminationFinding;
use Illuminate\Http\Request;

class MedicalExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function date(Request $request, Record $recordId)
    {
        $responseData = [
            'med_output' => '',
            'first_output' => '',
            'second_output' => '',
            'third_output' => '',
            'fourth_output' => '',
            'fifth_output' => '',
            'sixth_output' => '',
        ];

        $medical_exams = MedicalExam::where('id', $request->medical_exam_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereDate('date_created', $request->date_created)
                        ->orWhereNull('date_created');
                })
                ->orWhere(function ($query) use ($request) {
                    $query->whereDate('date_updated', $request->date_updated)
                        ->orWhereNull('date_updated');
                })
                ->orWhere('id', $request->id); 
            })
            ->get();
        
        if ($medical_exams){
            foreach ($medical_exams as $medical_exam){
                //Medical Exam Header
                if (auth()->user()->role->role == 'Nurse' || auth()->user()->role->role == 'Doctor'){
                    if ($medical_exam->date_updated && $medical_exam->date_created) {
                        $responseData['med_output'].='<span class="info">Original Copy</span>';
                    }else{
                        if(auth()->user()->role->role == 'Nurse'){
                            $responseData['med_output'].='<a class="info btn btn-info ml-2" href="'. route('nurse.medicalExamEdit', $medical_exam->id ) .'">Update</a>';
                        } else {
                            $responseData['med_output'].='<a class="info btn btn-info ml-2" href="'. route('doctor.medicalExamEdit', $medical_exam->id ) .'">Update</a>';
                        }
                    }
                } else {
                    if ($medical_exam->date_updated && $medical_exam->date_created) {
                        $responseData['med_output'].='<span class="info">Original Copy</span>';
                    } else if ($medical_exam->date_updated){
                        $responseData['med_output'].='<span class="info">Updated Version</span>';
                    }
                }

                //First Row
                $responseData['first_output'].='<div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">A. Past Medical Exam</label>
                </div>

                <!-- Past Medical Exam Content -->
                <table class="table table-sm table-bordered">
                    <!-- Table Head -->
                    <tr>
                        <th></th>
                        <th class="text-center">Normal</th>
                        <th class="text-center" width="650px">Findings</th>
                    </tr>

                    <!-- Table Body (Allergies) -->
                    <tr>
                        <td><span class="info">Allergies</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_allergies .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_allergies_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Skin Disease) -->
                    <tr>
                        <td><span class="info">Skin Disease</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_skin_disease .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_skin_disease_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Opthalmologic Disorder) -->
                    <tr>
                        <td><span class="info">Opthalmologic Disorder</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_opthalmologic_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_opthalmologic_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (ENT Disorder) -->
                    <tr>
                        <td><span class="info">ENT Disorder</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_ent_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_ent_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Bronchial Asthma) -->
                    <tr>
                        <td><span class="info">Bronchial Asthma</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_bronchial_asthma .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_bronchial_asthma_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Cardiac Disorder) -->
                    <tr>
                        <td><span class="info">Cardiac Disorder</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_cardiac_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_cardiac_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Diabetes Mellitus) -->
                    <tr>
                        <td><span class="info">Diabetes Mellitus</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_diabetes_mellitus .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_diabetes_mellitus_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Chronic Headache/Migraine) -->
                    <tr>
                        <td><span class="info">Chronic Headache / Migraine</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_chronic_headache .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_chronic_headache_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Hepatitis) -->
                    <tr>
                        <td><span class="info">Hepatitis</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_hepatitis .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_hepatitis_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Hypertension) -->
                    <tr>
                        <td><span class="info">Hypertension</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_hypertension .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_hypertension_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Thyroid Disorder) -->
                    <tr>
                        <td><span class="info">Thyroid Disorder</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_thyroid_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_thyroid_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Blood Disorder) -->
                    <tr>
                        <td><span class="info">Blood Disorder</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_blood_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_blood_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Tuberculosis) -->
                    <tr>
                        <td><span class="info">Tuberculosis</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_tuberculosis .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_tuberculosis_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Peptic Ulcer) -->
                    <tr>
                        <td><span class="info">Peptic Ulcer</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_peptic_ulcer .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_peptic_ulcer_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Musculoskeletal Disorder) -->
                    <tr>
                        <td><span class="info">Musculoskeletal Disorder</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_musculoskeletal_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_musculoskeletal_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Infectious Disease) -->
                    <tr>
                        <td><span class="info">Infectious Disease</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->past_medical_history->pmh_infectious_disease .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext text-center" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_infectious_disease_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Others) -->
                    <tr>
                        <td><span class="info">Others</span></td>
                        <td colspan="2">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->past_medical_history->pmh_finding->pmh_others .'</textarea>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>';

                //Second Row
                $responseData['second_output'].='<div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">B. Family History</label>
                </div>

                <!-- Family History Content -->
                <table class="table table-sm table-bordered">
                    <!-- Table Head -->
                    <tr>
                        <th></th>
                        <th class="text-center">Normal</th>
                        <th class="text-center" width="650px">Findings</th>
                    </tr>

                    <!-- Table Body (Bronchial Asthma) -->
                    <tr>
                        <td><span class="info">Bronchial Asthma</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_bronchial_asthma .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_bronchial_asthma_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Diabetes Mellitus) -->
                    <tr>
                        <td><span class="info">Diabetes Mellitus</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_diabetes_mellitus .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_diabetes_mellitus_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Thyroid Disorder) -->
                    <tr>
                        <td><span class="info">Thyroid Disorder</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_thyroid_disease .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_thyroid_disease_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Opthalmologic Disease) -->
                    <tr>
                        <td><span class="info">Opthalmologic Disease</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_opthalmologic_disease .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_opthalmologic_disease_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Cancer) -->
                    <tr>
                        <td><span class="info">Cancer</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_cancer .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_cancer_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Cardiac Disorder) -->
                    <tr>
                        <td><span class="info">Cardiac Disorder</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_cardiac_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_cardiac_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Hypertension) -->
                    <tr>
                        <td><span class="info">Hypertension</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_hypertension .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_hypertension_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Tuberculosis) -->
                    <tr>
                        <td><span class="info">Tuberculosis</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_tuberculosis .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_tuberculosis_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Nervous Disorder) -->
                    <tr>
                        <td><span class="info">Nervous Disorder</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_nervous_disorder .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_nervous_disorder_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Musculoskeletal) -->
                    <tr>
                        <td><span class="info">Musculoskeletal</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_musculoskeletal .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_musculoskeletal_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Liver Disease) -->
                    <tr>
                        <td><span class="info">Liver Disease</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_liver_disease .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_liver_disease_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Kidney Disease) -->
                    <tr>
                        <td><span class="info">Kidney Disease</td></span>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->family_history->fh_kidney_disease .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_kidney_disease_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Others) -->
                    <tr>
                        <td><span class="info">Others</span></td>
                        <td colspan="2">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->family_history->fh_finding->fh_others .'</textarea>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>';
                
                //Third Row
                $responseData['third_output'].='<div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">C. Personal and Social History</label>
                </div>
                
                <!-- Personal and Social History Content -->
                <!-- First Row -->
                <div class="row row-cols-3 pt-1 mx-auto border-top border-left border-right">
                    <div class="col">
                        <label class="info h4 mb-0">
                            <span class="info">Smoker:</span>
                        </label>
                    </div>';
                    if ($medical_exam->personal_social->smoker === 'No'){
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->smoker .'</span>
                            </div>';
                    } else {
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->day .' sticks / day</span>
                            </div>
                            <div class="col">
                                <span class="info">'. $medical_exam->personal_social->year .' pack year/s</span>
                            </div>';
                    }
                    $responseData['third_output'].='
                </div>
                
                <!-- Second Row -->
                <div class="row row-cols-3 pt-1 mx-auto border-bottom border-left border-right">
                    <div class="col">
                        <label class="info h4 mb-0">
                            <span class="info">Alcoholic:</span>
                        </label>
                    </div>';
                    if ($medical_exam->personal_social->alcoholic === 'No'){
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->alcoholic .'</span>
                            </div>';
                    } else {
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->shot .' bottle / shots</span>
                            </div>
                            <div class="col">
                                <span class="info">'. $medical_exam->personal_social->week .' /week</span>
                            </div>';
                    }
                    $responseData['third_output'].='
                </div>

                <!-- Third Row -->
                <div class="row py-1 mx-auto mt-1 border">
                    <div class="col col-sm-2">
                        <label class="info h5 mb-0">
                            <span class="info">Hospitalization/s:</span>
                        </label>
                    </div>';
                    if ($medical_exam->personal_social->hospitalization === 'No'){
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->hospitalization .'</span>
                            </div>';
                    } else {
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->hospitalization_result .'</span>
                            </div>';
                    }
                    $responseData['third_output'].='
                    <div class="col col-sm-2">
                        <label class="info h4 mb-0">
                            <span class="info">Operation/s:</span>
                        </label>
                    </div>';
                    if ($medical_exam->personal_social->operation === 'No'){
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->operation .'</span>
                            </div>';
                    } else {
                        $responseData['third_output'].='<div class="col">
                                <span class="info">'. $medical_exam->personal_social->hospitalization_result .'</span>
                            </div>';
                    }
                    $responseData['third_output'].='
                </div>

                <!-- Fourth Row -->
                <div class="row py-1 mx-auto mt-1 border">
                    <div class="col">
                        <label class="info mb-0" style="letter-">
                            <span class="info h4"><strong>Medications: </strong></span>
                        </label>';
                        if ($medical_exam->personal_social->medication === 'No'){
                            $responseData['third_output'].='
                                    <span class="info h3 ml-3">'. $medical_exam->personal_social->medication .'</span>';
                        } else {
                            $responseData['third_output'].='<div class="col">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->personal_social->med_take .'/textarea>
                                    </span>';
                        }
                        $responseData['third_output'].='
                    </div>
                </div>
            </div>';

                //Fourth Row
                $responseData['fourth_output'].='<div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">D. OB - Gyne History</label>
                </div>

                <!-- OB - Gyne History Content -->
                <table class="table table-sm table-bordered">
                    <!-- Table Head -->
                    <tr>
                        <th></th>
                        <th class="text-center">-</th>
                        <th class="text-center" width="650px">+</th>
                    </tr>

                    <!-- Table Body (LNMP) -->
                    <tr>
                        <td><span class="info">LNMP</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->obg_lnmp .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->obg_lnmp_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (OB Score) -->
                    <tr>
                        <td><span class="info">OB Score</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->obg_ob_score .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->obg_ob_score_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Abnormal Pregnancies) -->
                    <tr>
                        <td><span class="info">Abnormal Pregnancies</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->obg_abnormal_pregnancies .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->obg_abnormal_pregnancies_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Date of Last Delivery) -->
                    <tr>
                        <td><span class="info">Date of Last Delivery</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->obg_last_delivery .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->obg_last_delivery_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Breast / Uterus / Ovaries) -->
                    <tr>
                        <td><span class="info">Breast / Uterus / Ovaries</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->obg_breast_uterus_ovaries .'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->obg_breast_uterus_ovaries_findings .'</textarea>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>';

                //Fifth Row
                $responseData['fifth_output'].='<div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">E. Review of the Systems</label>
                </div>

                <!-- OB - Gyne History Content -->
                <table class="table table-sm table-bordered">
                    <!-- Table Head -->
                    <tr>
                        <th></th>
                        <th class="text-center">-</th>
                        <th class="text-center" width="650px">+</th>
                    </tr>

                    <!-- Table Body (Skin) -->
                    <tr>
                        <td><span class="info">Skin</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_skin.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_skin_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Opthalmologic) -->
                    <tr>
                        <td><span class="info">Opthalmologic</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_opthalmologic.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_opthalmologic_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (ENT) -->
                    <tr>
                        <td><span class="info">ENT</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_ent.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_ent_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Cardiovascular) -->
                    <tr>
                        <td><span class="info">Cardiovascular</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_cardiovascular.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_cardiovascular_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Respiratory) -->
                    <tr>
                        <td><span class="info">Respiratory</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_respiratory.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_respiratory_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Gastro-Intestinal) -->
                    <tr>
                        <td><span class="info">Gastro-Intestinal</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_gastro_intestinal.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_gastro_intestinal_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Neuro-Psychiatric) -->
                    <tr>
                        <td><span class="info">Neuro-Psychiatric</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_neuro_psychiatric.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_neuro_psychiatric_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Hermatology) -->
                    <tr>
                        <td><span class="info">Hermatology</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_hematology.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_hematology_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Genitourinary) -->
                    <tr>
                        <td><span class="info">Genitourinary</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_genitourinary.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_genitourinary_findings .'</textarea>
                            </span>
                        </td>
                    </tr>

                    <!-- Table Body (Musculo-Skeletal) -->
                    <tr>
                        <td><span class="info">Musculo-Skeletal</span></td>
                        <td class="text-center py-4">
                            <span class="info">'. $medical_exam->ob_gyne_review->rs_musculo_skeletal.'</span>
                        </td>
                        <td class="text-center">
                            <span class="info">
                                <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->ob_gyne_review->obr_finding->rs_musculo_skeletal_findings .'</textarea>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>';

                //Sixth Row
                $responseData['sixth_output'].='<div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">E. Physical Examination</label>
                </div>
            </div>
            
            <!-- Physical Examination 1st Content -->
            <div class="col">
                <div class="row mx-auto my-1">
                    <!-- Height -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">Height*:</label>
                            </div>
                            <div class="col text-center pb-2">
                                <span class="info">'. $medical_exam->physical_examination->height .' cm</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Weight -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">Weight*:</label>
                            </div>
                            <div class="col text-center pb-2">
                                <span class="info">'. $medical_exam->physical_examination->weight .'kg</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BP -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">BP* (mm/hg):</label>
                            </div>
                            <div class="col text-center pb-2">
                                <span class="info">'. $medical_exam->physical_examination->top_bp .' / '. $medical_exam->physical_examination->bot_bp .'</span>
                            </div>
                        </div>
                    </div>

                    <!-- Cardiac Rate -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">Cardiac Rate*:</label>
                            </div>
                            <div class="col text-center pb-2">
                                <span class="info">'. $medical_exam->physical_examination->pulse .'%</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Respiratory Rate -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">Respiratory Rate*:</label>
                            </div>
                            <div class="col text-center pb-2">
                                <span class="info">'. $medical_exam->physical_examination->respiratory_rate .'%</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BMI -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">BMI:</label>
                                <span id="HW_result"></span>
                            </div>
                            <div class="col text-center pb-2">
                                <span class="info">'. $medical_exam->physical_examination->bmi .'</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Physical Examination 2nd Content -->
            <div class="col">
                <div class="row">
                    <!-- Left -->
                    <div class="col pr-0">
                        <table class="table table-sm table-bordered">
                            <!-- Table Head -->
                            <tr>
                                <th></th>
                                <th class="text-center">Normal</th>
                                <th class="text-center" width="450px">Findings</th>
                            </tr>

                            <!-- Table Body (General Appearance) -->
                            <tr>
                                <td><span class="info">General Appearance</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_general_appearance .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_general_appearance_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Skin) -->
                            <tr>
                                <td><span class="info">Skin</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_skin .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_skin_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Head and Scalp) -->
                            <tr>
                                <td><span class="info">Head and Scalp</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_head_scalp .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_head_scalp_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Eyes) -->
                            <tr>
                                <td><span class="info">Eyes</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_eyes .'</span>
                                </td>
                                <td class="text-center">';
                                if ($medical_exam->physical_examination->pe_eyes === 'No'){
                                    $responseData['sixth_output'].='<div class="row">
                                        <!-- Eyes (OD) -->
                                        <div class="col">
                                            <div class="row row-cols-1">
                                                <div class="col">
                                                    <label class="info">OD:</label>
                                                </div>
                                                <div class="col">
                                                    <span class="info">'. $medical_exam->physical_examination->pe_finding->pe_eyes_top_od .' / '. $medical_exam->physical_examination->pe_finding->pe_eyes_bot_od .'</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Eyes (OS) -->
                                        <div class="col">
                                            <div class="row row-cols-1">
                                                <div class="col">
                                                    <label class="info">OS:</label>
                                                </div>
                                                <div class="col">
                                                <span class="info">'. $medical_exam->physical_examination->pe_finding->pe_eyes_top_os .' / '. $medical_exam->physical_examination->pe_finding->pe_eyes_bot_os .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                $responseData['sixth_output'].='</td>
                            </tr>

                            <!-- Table Body (Corrected) -->
                            <tr>
                                <td class="text-right"><span class="info">Corrected</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_corrected .'</span>
                                </td>
                                <td class="text-center">';
                                if ($medical_exam->physical_examination->pe_corrected === 'No'){
                                    $responseData['sixth_output'].='<div class="row">
                                    <!-- Corrected (OD) -->
                                    <div class="col">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <label class="info">OD:</label>
                                            </div>
                                            <div class="col">
                                                <span class="info">'. $medical_exam->physical_examination->pe_finding->pe_corrected_top_od .' / '. $medical_exam->physical_examination->pe_finding->pe_corrected_top_od .'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Corrected (OS) -->
                                    <div class="col">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <label class="info">OS:</label>
                                            </div>
                                            <div class="col">
                                                <span class="info">'. $medical_exam->physical_examination->pe_finding->pe_corrected_top_os .' / '. $medical_exam->physical_examination->pe_finding->pe_corrected_top_os .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                                $responseData['sixth_output'].='</td>
                            </tr>

                            <!-- Table Body (Pupils) -->
                            <tr>
                                <td><span class="info">Pupils</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_pupils .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_pupils_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Ear, Eardrums) -->
                            <tr>
                                <td><span class="info">Ear, Eardrums</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_ear_eardrums .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_ear_eardrums_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Nose, Sinuses) -->
                            <tr>
                                <td><span class="info">Nose, Sinuses</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_nose_sinuses .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_nose_sinuses_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Mouth, Throat) -->
                            <tr>
                                <td><span class="info">Mouth, Throat</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_mouth_throat .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_mouth_throat_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Neck, Thyroid) -->
                            <tr>
                                <td><span class="info">Neck, Thyroid</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_neck_thyroid .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_neck_thyroid_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Chest, Breast, Axilla) -->
                            <tr>
                                <td><span class="info">Chest, Breast, Axilla</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_chest_breast_axilla .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_chest_breast_axilla_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Rigth -->
                    <div class="col pl-0">
                        <table class="table table-sm table-bordered">
                            <!-- Table Head -->
                            <tr>
                                <th></th>
                                <th class="text-center">Normal</th>
                                <th class="text-center" width="450px">Findings</th>
                            </tr>

                            <!-- Table Body (Heart-Cardiovascular) -->
                            <tr>
                                <td><span class="info">Heart-Cardiovascular</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_heart_cardiovascular .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_heart_cardiovascular_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Lungs-Respiratory) -->
                            <tr>
                                <td><span class="info">Lungs-Respiratory</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_lungs_respiratory .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_lungs_respiratory_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Abdomen) -->
                            <tr>
                                <td><span class="info">Abdomen</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_abdomen .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_abdomen_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Back, Flanks) -->
                            <tr>
                                <td><span class="info">Back, Flanks</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_back_flanks .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_back_flanks_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Anus, Rectum) -->
                            <tr>
                                <td><span class="info">Anus, Rectum</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_anus_rectum .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_anus_rectum_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Genito-Urinary System) -->
                            <tr>
                                <td><span class="info">Genito-Urinary System</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_genito_urinary_system .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_genito_urinary_system_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Inguinal, Genitals) -->
                            <tr>
                                <td><span class="info">Inguinal, Genitals</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_inguinal_genitals .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_inguinal_genitals_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Musculo-Skeletal) -->
                            <tr>
                                <td><span class="info">Musculo-Skeletal</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_musculo_skeletal .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_musculo_skeletal_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Extremities) -->
                            <tr>
                                <td><span class="info">Extremities</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_extremities .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_extremities_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Reflexes) -->
                            <tr>
                                <td><span class="info">Reflexes</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_reflexes .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_reflexes_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>

                            <!-- Table Body (Neurological) -->
                            <tr>
                                <td><span class="info">Neurological</span></td>
                                <td class="text-center py-4">
                                    <span class="info">'. $medical_exam->physical_examination->pe_neurological .'</span>
                                </td>
                                <td class="text-center">
                                    <span class="info">
                                        <textarea class="form-control-plaintext" rows="2" readonly>'. $medical_exam->physical_examination->pe_finding->pe_neurological_findings .'</textarea>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Diagnosis -->
                <div class="row mx-auto mb-2">
                    <div class="col">
                        <label class="info h3">Daignosis:</label>
                        <textarea class="form-control-plaintext" row="3" readonly>'. $medical_exam->physical_examination->pe_finding->diagnosis .'</textarea>
                    </div>
                </div>
            </div>';
            }
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
            return view('nurse.record.medical-exam.record-me-create', compact('record'));
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return view('doctor.record.medical-exan.record-me-create', compact('record'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Connect Medical Exam ID to a specific Record ID
        $recordID = $request->input('record_id');
        $medical_examData = $request->all();
        $medical_examData['record_id'] = $recordID;

        //Creating Medical Exam
        $medical_exam = MedicalExam::create($medical_examData);

        //Connect Past Medical History ID to a specific Medical Exam ID
        $request->validate([
            'pmh_allergies' => 'string',
            'pmh_skin_disease' => 'string',
            'pmh_opthalmologic_disorder' => 'string',
            'pmh_ent_disorder' => 'string',
            'pmh_bronchial_asthma' => 'string',
            'pmh_cardiac_disorder' => 'string',
            'pmh_diabetes_mellitus' => 'string',
            'pmh_chronic_headache' => 'string',
            'pmh_hepatitis' => 'string',
            'pmh_hypertension' => 'string',
            'pmh_thyroid_disorder' => 'string',
            'pmh_blood_disorder' => 'string',
            'pmh_tuberculosis' => 'string',
            'pmh_peptic_ulcer' => 'string',
            'pmh_musculoskeletal_disorder' => 'string',
            'pmh_infectious_disease' => 'string',
        ]);

        $medical_examID = $medical_exam->id;
        $past_medical_historyData = $request->all();
        $past_medical_historyData['medical_exam_id'] = $medical_examID;

        //Creating Past Medical History
        $past_medical_history = PastMedicalHistory::create($past_medical_historyData);

        //Connect Past Medical History Findings ID to a specific Past Medical History ID
        $request->validate([
            'pmh_allergies_findings' => 'max:250',
            'pmh_skin_disease_findings' => 'max:250',
            'pmh_opthalmologic_disorder_findings' => 'max:250',
            'pmh_ent_disorder_findings' => 'max:250',
            'pmh_bronchial_asthma_findings' => 'max:250',
            'pmh_cardiac_disorder_findings' => 'max:250',
            'pmh_diabetes_mellitus_findings' => 'max:250',
            'pmh_chronic_headache_findings' => 'max:250',
            'pmh_hepatitis_findings' => 'max:250',
            'pmh_hypertension_findings' => 'max:250',
            'pmh_thyroid_disorder_findings' => 'max:250',
            'pmh_blood_disorder_findings' => 'max:250',
            'pmh_tuberculosis_findings' => 'max:250',
            'pmh_peptic_ulcer_findings' => 'max:250',
            'pmh_musculoskeletal_disorder_findings' => 'max:250',
            'pmh_infectious_disease_findings' => 'max:250',
            'pmh_others' => 'max:250',
        ]);

        $past_medical_historyID = $past_medical_history->id;
        $past_medical_history_findingData  = $request->all();
        $past_medical_history_findingData['past_medical_history_id'] = $past_medical_historyID;

        PastMedicalHistoryFinding::create($past_medical_history_findingData);

        //Connect Family History ID to a specific Medical Exam ID
        $request->validate([
            'fh_bronchial_asthma' => 'string',
            'fh_diabetes_mellitus' => 'string',
            'fh_thyroid_disease' => 'string',
            'fh_opthalmologic_disease' => 'string',
            'fh_cancer' => 'string',
            'fh_cardiac_disorder' => 'string',
            'fh_hypertension' => 'string',
            'fh_tuberculosis' => 'string',
            'fh_nervous_disorder' => 'string',
            'fh_musculoskeletal' => 'string',
            'fh_liver_disease' => 'string',
            'fh_kidney_disease' => 'string',
        ]);

        $family_historyData = $request->all();
        $family_historyData['medical_exam_id'] = $medical_examID;

        //Create Family History
        $family_history = FamilyHistory::create($family_historyData);

        //Connect Family History Findings ID to a specific Family History ID
        $request->validate([
            'fh_bronchial_asthma_findings' => 'max:250',
            'fh_diabetes_mellitus_findings' => 'max:250',
            'fh_thyroid_disease_findings' => 'max:250',
            'fh_opthalmologic_disease_findings' => 'max:250',
            'fh_cancer_findings' => 'max:250',
            'fh_cardiac_disorder_findings' => 'max:250',
            'fh_hypertension_findings' => 'max:250',
            'fh_tuberculosis_findings' => 'max:250',
            'fh_nervous_disorder_findings' => 'max:250',
            'fh_musculoskeletal_findings' => 'max:250',
            'fh_liver_disease_findings' => 'max:250',
            'fh_kidney_disease_findings' => 'max:250',
            'fh_others' => 'max:250',
        ]);

        $family_historyID = $family_history->id;
        $family_history_findingData = $request->all();
        $family_history_findingData['family_history_id'] = $family_historyID;

        FamilyHistoryFinding::create($family_history_findingData);

        //Connect Personal and Social ID to a specific Medical Exam ID
        $request->validate([
            'smoker' => 'string',
            'day' => 'integer',
            'year' => 'integer',
            'alcoholic' => 'string',
            'shot' => 'integer',
            'week' => 'integer',
            'medication' => 'string',
            'med_take' => 'string',
            'hospitalization' => 'max:250',
            'hospitalization_result' => 'integer',
            'operation' => 'string',
            'operation_result' => 'integer',
        ]);

        $personal_socialData = $request->all();
        $personal_socialData['medical_exam_id'] = $medical_examID;

        PersonalSocial::create($personal_socialData);

        //Connect OB-Gyne and Review of the System ID to a specific Medical Exam ID
        $request->validate([
            'obg_lnmp' => 'string',
            'obg_ob_score' => 'string',
            'obg_abnormal_pregnancies' => 'string',
            'obg_last_delivery' => 'string',
            'obg_breast_uterus_ovaries' => 'string',
            'rs_skin' => 'string',
            'rs_opthalmologic' => 'string',
            'rs_ent' => 'string',
            'rs_cardiovascular' => 'string',
            'rs_respiratory' => 'string',
            'rs_gastro_intestinal' => 'string',
            'rs_neuro_psychiatric' => 'string',
            'rs_hematology' => 'string',
            'rs_genitourinary' => 'string',
            'rs_musculo_skeletal' => 'string',
        ]);
        
        $ob_gyne_reviewData = $request->all();
        $ob_gyne_reviewData['medical_exam_id'] = $medical_examID;
        
        //Create OB-Gyne and Review of the System
        $ob_gyne_review = OBGyneReview::create($ob_gyne_reviewData);
        
        //Connect OB-Gyne and Review of the System Findings ID to a specific OB-Gyne and Review of the System ID
        $request->validate([
            'obg_lnmp_findings' => 'max:250',
            'obg_ob_score_findings' => 'max:250',
            'obg_abnormal_pregnancies_findings' => 'max:250',
            'obg_last_delivery_findings' => 'max:250',
            'obg_breast_uterus_ovaries_findings' => 'max:250',
            'rs_skin_findings' => 'max:250',
            'rs_opthalmologic_findings' => 'max:250',
            'rs_ent_findings' => 'max:250',
            'rs_cardiovascular_findings' => 'max:250',
            'rs_respiratory_findings' => 'max:250',
            'rs_gastro_intestinal_findings' => 'max:250',
            'rs_neuro_psychiatric_findings' => 'max:250',
            'rs_hematology_findings' => 'max:250',
            'rs_genitourinary_findings' => 'max:250',
            'rs_musculo_skeletal_findings' => 'max:250',
        ]);
        
        $ob_gyne_reviewID = $ob_gyne_review->id;
        $ob_gyne_review_findingData = $request->all();
        $ob_gyne_review_findingData['ob_gyne_review_id'] = $ob_gyne_reviewID;
        
        ObGyneReviewFinding::create($ob_gyne_review_findingData);

        //Connect OB-Gyne and Review of the System ID to a specific Medical Exam ID
        $request->validate([
            'height' => 'integer',
            'weight' => 'integer',
            'top_bp' => 'integer',
            'bot_bp' => 'integer',
            'pulse' => 'integer',
            'respiratory_rate' => 'integer',
            'bmi' => 'numeric',
            'pe_general_appearance' => 'string',
            'pe_skin' => 'string',
            'pe_head_scalp' => 'string',
            'pe_eyes' => 'string',
            'pe_corrected' => 'string',
            'pe_pupils' => 'string',
            'pe_ear_eardrums' => 'string',
            'pe_nose_sinuses' => 'string',
            'pe_mouth_throat' => 'string',
            'pe_neck_thyroid' => 'string',
            'pe_chest_breast_axilla' => 'string',
            'pe_heart_cardiovascular' => 'string',
            'pe_lungs_respiratory' => 'string',
            'pe_abdomen' => 'string',
            'pe_back_flanks' => 'string',
            'pe_anus_rectum' => 'string',
            'pe_genito_urinary_system' => 'string',
            'pe_inguinal_genitals' => 'string',
            'pe_musculo_skeletal' => 'string',
            'pe_extremities' => 'string',
            'pe_reflexes' => 'string',
            'pe_neurological' => 'string',
        ]);
        
        $physical_examinationData = $request->all();
        $physical_examinationData['medical_exam_id'] = $medical_examID;
        
        //Create OB-Gyne and Review of the System
        $physical_examination = PhysicalExamination::create($physical_examinationData);
        
        //Connect OB-Gyne and Review of the System Findings ID to a specific OB-Gyne and Review of the System ID
        $request->validate([
            'pe_general_appearance_findings' => 'max:250',
            'pe_skin_findings' => 'max:250',
            'pe_head_scalp_findings' => 'max:250',
            'pe_eyes_top_od' => 'max:250',
            'pe_eyes_bot_od' => 'max:250',
            'pe_eyes_top_os' => 'max:250',
            'pe_eyes_bot_os' => 'max:250',
            'pe_corrected_top_od' => 'max:250',
            'pe_corrected_bot_od' => 'max:250',
            'pe_corrected_top_os' => 'max:250',
            'pe_corrected_bot_os' => 'max:250',
            'pe_pupils_findings' => 'max:250',
            'pe_ear_eardrums_findings' => 'max:250',
            'pe_nose_sinuses_findings' => 'max:250',
            'pe_mouth_throat_findings' => 'max:250',
            'pe_neck_thyroid_findings' => 'max:250',
            'pe_chest_breast_axilla_findings' => 'max:250',
            'pe_heart_cardiovascular_findings' => 'max:250',
            'pe_lungs_respiratory_findings' => 'max:250',
            'pe_abdomen_findings' => 'max:250',
            'pe_back_flanks_findings' => 'max:250',
            'pe_anus_rectum_findings' => 'max:250',
            'pe_genito_urinary_system_findings' => 'max:250',
            'pe_inguinal_genitals_findings' => 'max:250',
            'pe_musculo_skeletal_findings' => 'max:250',
            'pe_extremities_findings' => 'max:250',
            'pe_reflexes_findings' => 'max:250',
            'pe_neurological_findings' => 'max:250',
            'diagnosis' => 'max:250',
        ]);
        
        $physical_examinationID = $physical_examination->id;
        $physical_examination_findingData = $request->all();
        $physical_examination_findingData['physical_examination_id'] = $physical_examinationID;
        
        PhysicalExaminationFinding::create($physical_examination_findingData);

        if(auth()->user()->role->role == 'Nurse')
        {
            return redirect()->route('nurse.recordShow', ['record' => $recordID])->with('success', 'Medical exam created successfully.');
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return redirect()->route('doctor.recordShow', ['record' => $recordID])->with('success', 'Medical exam created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalExam $medical_exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalExam $medical_exam)
    {
        if(auth()->user()->role->role == 'Nurse')
        {
            return view('nurse.record.medical-exam.record-me-edit', compact('medical_exam'));
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return view('doctor.record.medical-exam.record-me-edit', compact('medical_exam'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalExam $medical_exam)
    {
        if ($medical_exam->date_updated === null) {
            $medical_exam->update(['date_created' => $medical_exam->date_created,
                                    'date_updated' => $medical_exam->date_created]);
            $medical_examData = ['date_updated' => $request->input('date_updated')];
            $medical_examData['record_id'] = $medical_exam->record->id;

            //Creating Medical Exam
            $medical_exam = MedicalExam::create($medical_examData);

            //Connect Past Medical History ID to a specific Medical Exam ID
            $request->validate([
                'pmh_allergies' => 'string',
                'pmh_skin_disease' => 'string',
                'pmh_opthalmologic_disorder' => 'string',
                'pmh_ent_disorder' => 'string',
                'pmh_bronchial_asthma' => 'string',
                'pmh_cardiac_disorder' => 'string',
                'pmh_diabetes_mellitus' => 'string',
                'pmh_chronic_headache' => 'string',
                'pmh_hepatitis' => 'string',
                'pmh_hypertension' => 'string',
                'pmh_thyroid_disorder' => 'string',
                'pmh_blood_disorder' => 'string',
                'pmh_tuberculosis' => 'string',
                'pmh_peptic_ulcer' => 'string',
                'pmh_musculoskeletal_disorder' => 'string',
                'pmh_infectious_disease' => 'string',
            ]);

            $medical_examID = $medical_exam->id;
            $past_medical_historyData = $request->all();
            $past_medical_historyData['medical_exam_id'] = $medical_examID;

            //Creating Past Medical History
            $past_medical_history = PastMedicalHistory::create($past_medical_historyData);

            //Connect Past Medical History Findings ID to a specific Past Medical History ID
            $request->validate([
                'pmh_allergies_findings' => 'max:250',
                'pmh_skin_disease_findings' => 'max:250',
                'pmh_opthalmologic_disorder_findings' => 'max:250',
                'pmh_ent_disorder_findings' => 'max:250',
                'pmh_bronchial_asthma_findings' => 'max:250',
                'pmh_cardiac_disorder_findings' => 'max:250',
                'pmh_diabetes_mellitus_findings' => 'max:250',
                'pmh_chronic_headache_findings' => 'max:250',
                'pmh_hepatitis_findings' => 'max:250',
                'pmh_hypertension_findings' => 'max:250',
                'pmh_thyroid_disorder_findings' => 'max:250',
                'pmh_blood_disorder_findings' => 'max:250',
                'pmh_tuberculosis_findings' => 'max:250',
                'pmh_peptic_ulcer_findings' => 'max:250',
                'pmh_musculoskeletal_disorder_findings' => 'max:250',
                'pmh_infectious_disease_findings' => 'max:250',
                'pmh_others' => 'max:250',
            ]);

            $past_medical_historyID = $past_medical_history->id;
            $past_medical_history_findingData  = $request->all();
            $past_medical_history_findingData['past_medical_history_id'] = $past_medical_historyID;

            PastMedicalHistoryFinding::create($past_medical_history_findingData);

            //Connect Family History ID to a specific Medical Exam ID
            $request->validate([
                'fh_bronchial_asthma' => 'string',
                'fh_diabetes_mellitus' => 'string',
                'fh_thyroid_disease' => 'string',
                'fh_opthalmologic_disease' => 'string',
                'fh_cancer' => 'string',
                'fh_cardiac_disorder' => 'string',
                'fh_hypertension' => 'string',
                'fh_tuberculosis' => 'string',
                'fh_nervous_disorder' => 'string',
                'fh_musculoskeletal' => 'string',
                'fh_liver_disease' => 'string',
                'fh_kidney_disease' => 'string',
            ]);

            $family_historyData = $request->all();
            $family_historyData['medical_exam_id'] = $medical_examID;

            //Create Family History
            $family_history = FamilyHistory::create($family_historyData);

            //Connect Family History Findings ID to a specific Family History ID
            $request->validate([
                'fh_bronchial_asthma_findings' => 'max:250',
                'fh_diabetes_mellitus_findings' => 'max:250',
                'fh_thyroid_disease_findings' => 'max:250',
                'fh_opthalmologic_disease_findings' => 'max:250',
                'fh_cancer_findings' => 'max:250',
                'fh_cardiac_disorder_findings' => 'max:250',
                'fh_hypertension_findings' => 'max:250',
                'fh_tuberculosis_findings' => 'max:250',
                'fh_nervous_disorder_findings' => 'max:250',
                'fh_musculoskeletal_findings' => 'max:250',
                'fh_liver_disease_findings' => 'max:250',
                'fh_kidney_disease_findings' => 'max:250',
                'fh_others' => 'max:250',
            ]);

            $family_historyID = $family_history->id;
            $family_history_findingData = $request->all();
            $family_history_findingData['family_history_id'] = $family_historyID;

            FamilyHistoryFinding::create($family_history_findingData);

            //Connect Personal and Social ID to a specific Medical Exam ID
            $request->validate([
                'smoker' => 'string',
                'day' => 'integer',
                'year' => 'integer',
                'alcoholic' => 'string',
                'shot' => 'integer',
                'week' => 'integer',
                'medication' => 'string',
                'med_take' => 'string',
                'hospitalization' => 'max:250',
                'hospitalization_result' => 'integer',
                'operation' => 'string',
                'operation_result' => 'integer',
            ]);

            $personal_socialData = $request->all();
            $personal_socialData['medical_exam_id'] = $medical_examID;

            PersonalSocial::create($personal_socialData);

            //Connect OB-Gyne and Review of the System ID to a specific Medical Exam ID
            $request->validate([
                'obg_lnmp' => 'string',
                'obg_ob_score' => 'string',
                'obg_abnormal_pregnancies' => 'string',
                'obg_last_delivery' => 'string',
                'obg_breast_uterus_ovaries' => 'string',
                'rs_skin' => 'string',
                'rs_opthalmologic' => 'string',
                'rs_ent' => 'string',
                'rs_cardiovascular' => 'string',
                'rs_respiratory' => 'string',
                'rs_gastro_intestinal' => 'string',
                'rs_neuro_psychiatric' => 'string',
                'rs_hematology' => 'string',
                'rs_genitourinary' => 'string',
                'rs_musculo_skeletal' => 'string',
            ]);
            
            $ob_gyne_reviewData = $request->all();
            $ob_gyne_reviewData['medical_exam_id'] = $medical_examID;
            
            //Create OB-Gyne and Review of the System
            $ob_gyne_review = OBGyneReview::create($ob_gyne_reviewData);
            
            //Connect OB-Gyne and Review of the System Findings ID to a specific OB-Gyne and Review of the System ID
            $request->validate([
                'obg_lnmp_findings' => 'max:250',
                'obg_ob_score_findings' => 'max:250',
                'obg_abnormal_pregnancies_findings' => 'max:250',
                'obg_last_delivery_findings' => 'max:250',
                'obg_breast_uterus_ovaries_findings' => 'max:250',
                'rs_skin_findings' => 'max:250',
                'rs_opthalmologic_findings' => 'max:250',
                'rs_ent_findings' => 'max:250',
                'rs_cardiovascular_findings' => 'max:250',
                'rs_respiratory_findings' => 'max:250',
                'rs_gastro_intestinal_findings' => 'max:250',
                'rs_neuro_psychiatric_findings' => 'max:250',
                'rs_hematology_findings' => 'max:250',
                'rs_genitourinary_findings' => 'max:250',
                'rs_musculo_skeletal_findings' => 'max:250',
            ]);
            
            $ob_gyne_reviewID = $ob_gyne_review->id;
            $ob_gyne_review_findingData = $request->all();
            $ob_gyne_review_findingData['ob_gyne_review_id'] = $ob_gyne_reviewID;
            
            ObGyneReviewFinding::create($ob_gyne_review_findingData);

            //Connect OB-Gyne and Review of the System ID to a specific Medical Exam ID
            $request->validate([
                'height' => 'integer',
                'weight' => 'integer',
                'top_bp' => 'integer',
                'bot_bp' => 'integer',
                'pulse' => 'integer',
                'respiratory_rate' => 'integer',
                'bmi' => 'numeric',
                'pe_general_appearance' => 'string',
                'pe_skin' => 'string',
                'pe_head_scalp' => 'string',
                'pe_eyes' => 'string',
                'pe_corrected' => 'string',
                'pe_pupils' => 'string',
                'pe_ear_eardrums' => 'string',
                'pe_nose_sinuses' => 'string',
                'pe_mouth_throat' => 'string',
                'pe_neck_thyroid' => 'string',
                'pe_chest_breast_axilla' => 'string',
                'pe_heart_cardiovascular' => 'string',
                'pe_lungs_respiratory' => 'string',
                'pe_abdomen' => 'string',
                'pe_back_flanks' => 'string',
                'pe_anus_rectum' => 'string',
                'pe_genito_urinary_system' => 'string',
                'pe_inguinal_genitals' => 'string',
                'pe_musculo_skeletal' => 'string',
                'pe_extremities' => 'string',
                'pe_reflexes' => 'string',
                'pe_neurological' => 'string',
            ]);
            
            $physical_examinationData = $request->all();
            $physical_examinationData['medical_exam_id'] = $medical_examID;
            
            //Create OB-Gyne and Review of the System
            $physical_examination = PhysicalExamination::create($physical_examinationData);
            
            //Connect OB-Gyne and Review of the System Findings ID to a specific OB-Gyne and Review of the System ID
            $request->validate([
                'pe_general_appearance_findings' => 'max:250',
                'pe_skin_findings' => 'max:250',
                'pe_head_scalp_findings' => 'max:250',
                'pe_eyes_top_od' => 'max:250',
                'pe_eyes_bot_od' => 'max:250',
                'pe_eyes_top_os' => 'max:250',
                'pe_eyes_bot_os' => 'max:250',
                'pe_corrected_top_od' => 'max:250',
                'pe_corrected_bot_od' => 'max:250',
                'pe_corrected_top_os' => 'max:250',
                'pe_corrected_bot_os' => 'max:250',
                'pe_pupils_findings' => 'max:250',
                'pe_ear_eardrums_findings' => 'max:250',
                'pe_nose_sinuses_findings' => 'max:250',
                'pe_mouth_throat_findings' => 'max:250',
                'pe_neck_thyroid_findings' => 'max:250',
                'pe_chest_breast_axilla_findings' => 'max:250',
                'pe_heart_cardiovascular_findings' => 'max:250',
                'pe_lungs_respiratory_findings' => 'max:250',
                'pe_abdomen_findings' => 'max:250',
                'pe_back_flanks_findings' => 'max:250',
                'pe_anus_rectum_findings' => 'max:250',
                'pe_genito_urinary_system_findings' => 'max:250',
                'pe_inguinal_genitals_findings' => 'max:250',
                'pe_musculo_skeletal_findings' => 'max:250',
                'pe_extremities_findings' => 'max:250',
                'pe_reflexes_findings' => 'max:250',
                'pe_neurological_findings' => 'max:250',
                'diagnosis' => 'max:250',
            ]);
            
            $physical_examinationID = $physical_examination->id;
            $physical_examination_findingData = $request->all();
            $physical_examination_findingData['physical_examination_id'] = $physical_examinationID;
            
            PhysicalExaminationFinding::create($physical_examination_findingData);
        } else {

            $medical_exam->update($request->all()); 

            //Connect Past Medical History ID to a specific Medical Exam ID
            $request->validate([
                'pmh_allergies' => 'string',
                'pmh_skin_disease' => 'string',
                'pmh_opthalmologic_disorder' => 'string',
                'pmh_ent_disorder' => 'string',
                'pmh_bronchial_asthma' => 'string',
                'pmh_cardiac_disorder' => 'string',
                'pmh_diabetes_mellitus' => 'string',
                'pmh_chronic_headache' => 'string',
                'pmh_hepatitis' => 'string',
                'pmh_hypertension' => 'string',
                'pmh_thyroid_disorder' => 'string',
                'pmh_blood_disorder' => 'string',
                'pmh_tuberculosis' => 'string',
                'pmh_peptic_ulcer' => 'string',
                'pmh_musculoskeletal_disorder' => 'string',
                'pmh_infectious_disease' => 'string',
            ]);

            $medical_exam->past_medical_history->update($request->all());

            //Connect Past Medical History Findings ID to a specific Past Medical History ID
            $request->validate([
                'pmh_allergies_findings' => 'max:250',
                'pmh_skin_disease_findings' => 'max:250',
                'pmh_opthalmologic_disorder_findings' => 'max:250',
                'pmh_ent_disorder_findings' => 'max:250',
                'pmh_bronchial_asthma_findings' => 'max:250',
                'pmh_cardiac_disorder_findings' => 'max:250',
                'pmh_diabetes_mellitus_findings' => 'max:250',
                'pmh_chronic_headache_findings' => 'max:250',
                'pmh_hepatitis_findings' => 'max:250',
                'pmh_hypertension_findings' => 'max:250',
                'pmh_thyroid_disorder_findings' => 'max:250',
                'pmh_blood_disorder_findings' => 'max:250',
                'pmh_tuberculosis_findings' => 'max:250',
                'pmh_peptic_ulcer_findings' => 'max:250',
                'pmh_musculoskeletal_disorder_findings' => 'max:250',
                'pmh_infectious_disease_findings' => 'max:250',
                'pmh_others' => 'max:250',
            ]);

            $medical_exam->past_medical_history->pmh_finding->update($request->all());

            //Connect Family History ID to a specific Medical Exam ID
            $request->validate([
                'fh_bronchial_asthma' => 'string',
                'fh_diabetes_mellitus' => 'string',
                'fh_thyroid_disease' => 'string',
                'fh_opthalmologic_disease' => 'string',
                'fh_cancer' => 'string',
                'fh_cardiac_disorder' => 'string',
                'fh_hypertension' => 'string',
                'fh_tuberculosis' => 'string',
                'fh_nervous_disorder' => 'string',
                'fh_musculoskeletal' => 'string',
                'fh_liver_disease' => 'string',
                'fh_kidney_disease' => 'string',
            ]);

            $medical_exam->family_history->update($request->all());

            //Connect Family History Findings ID to a specific Family History ID
            $request->validate([
                'fh_bronchial_asthma_findings' => 'max:250',
                'fh_diabetes_mellitus_findings' => 'max:250',
                'fh_thyroid_disease_findings' => 'max:250',
                'fh_opthalmologic_disease_findings' => 'max:250',
                'fh_cancer_findings' => 'max:250',
                'fh_cardiac_disorder_findings' => 'max:250',
                'fh_hypertension_findings' => 'max:250',
                'fh_tuberculosis_findings' => 'max:250',
                'fh_nervous_disorder_findings' => 'max:250',
                'fh_musculoskeletal_findings' => 'max:250',
                'fh_liver_disease_findings' => 'max:250',
                'fh_kidney_disease_findings' => 'max:250',
                'fh_others' => 'max:250',
            ]);

            $medical_exam->family_history->fh_finding->update($request->all());

            //Connect Personal and Social ID to a specific Medical Exam ID
            $request->validate([
                'smoker' => 'string',
                'day' => 'integer',
                'year' => 'integer',
                'alcoholic' => 'string',
                'shot' => 'integer',
                'week' => 'integer',
                'medication' => 'string',
                'med_take' => 'string',
                'hospitalization' => 'max:250',
                'hospitalization_result' => 'integer',
                'operation' => 'string',
                'operation_result' => 'integer',
            ]);

            $medical_exam->personal_social->update($request->all());

            //Connect OB-Gyne and Review of the System ID to a specific Medical Exam ID
            $request->validate([
                'obg_lnmp' => 'string',
                'obg_ob_score' => 'string',
                'obg_abnormal_pregnancies' => 'string',
                'obg_last_delivery' => 'string',
                'obg_breast_uterus_ovaries' => 'string',
                'rs_skin' => 'string',
                'rs_opthalmologic' => 'string',
                'rs_ent' => 'string',
                'rs_cardiovascular' => 'string',
                'rs_respiratory' => 'string',
                'rs_gastro_intestinal' => 'string',
                'rs_neuro_psychiatric' => 'string',
                'rs_hematology' => 'string',
                'rs_genitourinary' => 'string',
                'rs_musculo_skeletal' => 'string',
            ]);
            
            $medical_exam->ob_gyne_review->update($request->all());
            
            //Connect OB-Gyne and Review of the System Findings ID to a specific OB-Gyne and Review of the System ID
            $request->validate([
                'obg_lnmp_findings' => 'max:250',
                'obg_ob_score_findings' => 'max:250',
                'obg_abnormal_pregnancies_findings' => 'max:250',
                'obg_last_delivery_findings' => 'max:250',
                'obg_breast_uterus_ovaries_findings' => 'max:250',
                'rs_skin_findings' => 'max:250',
                'rs_opthalmologic_findings' => 'max:250',
                'rs_ent_findings' => 'max:250',
                'rs_cardiovascular_findings' => 'max:250',
                'rs_respiratory_findings' => 'max:250',
                'rs_gastro_intestinal_findings' => 'max:250',
                'rs_neuro_psychiatric_findings' => 'max:250',
                'rs_hematology_findings' => 'max:250',
                'rs_genitourinary_findings' => 'max:250',
                'rs_musculo_skeletal_findings' => 'max:250',
            ]);
            
            $medical_exam->ob_gyne_review->obr_finding->update($request->all());

            //Connect OB-Gyne and Review of the System ID to a specific Medical Exam ID
            $request->validate([
                'height' => 'integer',
                'weight' => 'integer',
                'top_bp' => 'integer',
                'bot_bp' => 'integer',
                'pulse' => 'integer',
                'respiratory_rate' => 'integer',
                'bmi' => 'numeric',
                'pe_general_appearance' => 'string',
                'pe_skin' => 'string',
                'pe_head_scalp' => 'string',
                'pe_eyes' => 'string',
                'pe_corrected' => 'string',
                'pe_pupils' => 'string',
                'pe_ear_eardrums' => 'string',
                'pe_nose_sinuses' => 'string',
                'pe_mouth_throat' => 'string',
                'pe_neck_thyroid' => 'string',
                'pe_chest_breast_axilla' => 'string',
                'pe_heart_cardiovascular' => 'string',
                'pe_lungs_respiratory' => 'string',
                'pe_abdomen' => 'string',
                'pe_back_flanks' => 'string',
                'pe_anus_rectum' => 'string',
                'pe_genito_urinary_system' => 'string',
                'pe_inguinal_genitals' => 'string',
                'pe_musculo_skeletal' => 'string',
                'pe_extremities' => 'string',
                'pe_reflexes' => 'string',
                'pe_neurological' => 'string',
            ]);
            
            $medical_exam->physical_examination->update($request->all());
            
            //Connect OB-Gyne and Review of the System Findings ID to a specific OB-Gyne and Review of the System ID
            $request->validate([
                'pe_general_appearance_findings' => 'max:250',
                'pe_skin_findings' => 'max:250',
                'pe_head_scalp_findings' => 'max:250',
                'pe_eyes_top_od' => 'max:250',
                'pe_eyes_bot_od' => 'max:250',
                'pe_eyes_top_os' => 'max:250',
                'pe_eyes_bot_os' => 'max:250',
                'pe_corrected_top_od' => 'max:250',
                'pe_corrected_bot_od' => 'max:250',
                'pe_corrected_top_os' => 'max:250',
                'pe_corrected_bot_os' => 'max:250',
                'pe_pupils_findings' => 'max:250',
                'pe_ear_eardrums_findings' => 'max:250',
                'pe_nose_sinuses_findings' => 'max:250',
                'pe_mouth_throat_findings' => 'max:250',
                'pe_neck_thyroid_findings' => 'max:250',
                'pe_chest_breast_axilla_findings' => 'max:250',
                'pe_heart_cardiovascular_findings' => 'max:250',
                'pe_lungs_respiratory_findings' => 'max:250',
                'pe_abdomen_findings' => 'max:250',
                'pe_back_flanks_findings' => 'max:250',
                'pe_anus_rectum_findings' => 'max:250',
                'pe_genito_urinary_system_findings' => 'max:250',
                'pe_inguinal_genitals_findings' => 'max:250',
                'pe_musculo_skeletal_findings' => 'max:250',
                'pe_extremities_findings' => 'max:250',
                'pe_reflexes_findings' => 'max:250',
                'pe_neurological_findings' => 'max:250',
                'diagnosis' => 'max:250',
            ]);
            
            $medical_exam->physical_examination->pe_finding->update($request->all());
        }

        if(auth()->user()->role->role == 'Nurse')
        {
            return redirect()->route('nurse.recordShow', ['record' => $medical_exam->record->id])->with('success', 'Medical exam created successfully.');
        }
        elseif(auth()->user()->role->role == 'Doctor')
        {
            return redirect()->route('doctor.recordShow', ['record' => $medical_exam->record->id])->with('success', 'Medical exam created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalExam $medical_exam)
    {
        //
    }
}
