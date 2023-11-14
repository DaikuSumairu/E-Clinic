@extends('adminlte::page')

<!-- Tabs Title -->
@section('title', 'Creating Medical Exam')

<!-- Content Header -->
@section('content_header')
    <h1>Creating Medical Exam for {{ $record->user->name }}</h1>
@stop

<!-- Content Body -->
@section('content')
<!-- Go back from the last page -->
<a class="btn btn-danger mb-2" href="{{ route('nurse.recordShow', $record->id) }}">Go Back</a>

<!-- Body -->
<div class="container-xxl mb-2 record-customize-create-container-height border">
    <form method="POST" action="{{ route('nurse.medicalExamStore') }}" onsubmit="return confirm('Are you sure you want to submit this medical exam?');">
        @csrf
        <!-- Hidden value to be save on consultation -->
        <input type="hidden" name="record_id" value="{{ $record->id }}">

        <!-- Date -->
        <div class="row">
            <div class="col text-right pt-2">
                <i class="far fa-calendar"></i>
            </div>
            <div class="col-sm-2">
                <input type="date" class="form-control-plaintext" id="current_date" name="date_created" readonly>
            </div>
        </div>

        <!-- First Row -->
        <div class="row">
            <div class="col">
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
                        <td>Allergies</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_allergies" name="pmh_allergies" value="Yes" onchange="toggleText_area('pmh_allergies')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_allergies" rows="2" name="pmh_allergies_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Skin Disease) -->
                    <tr>
                        <td>Skin Disease</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_skin_disease" name="pmh_skin_disease" value="Yes" onchange="toggleText_area('pmh_skin_disease')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_skin_disease" rows="2" name="pmh_skin_disease_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Opthalmologic Disorder) -->
                    <tr>
                        <td>Opthalmologic Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_opthalmologic_disorder" name="pmh_opthalmologic_disorder" value="Yes" onchange="toggleText_area('pmh_opthalmologic_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_opthalmologic_disorder" rows="2" name="pmh_opthalmologic_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (ENT Disorder) -->
                    <tr>
                        <td>ENT Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_ent_disorder" name="pmh_ent_disorder" value="Yes" onchange="toggleText_area('pmh_ent_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_ent_disorder" rows="2" name="pmh_ent_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Bronchial Asthma) -->
                    <tr>
                        <td>Bronchial Asthma</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_bronchial_asthma" name="pmh_bronchial_asthma" value="Yes" onchange="toggleText_area('pmh_bronchial_asthma')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_bronchial_asthma" rows="2" name="pmh_bronchial_asthma_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Cardiac Disorder) -->
                    <tr>
                        <td>Cardiac Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_cardiac_disorder" name="pmh_cardiac_disorder" value="Yes" onchange="toggleText_area('pmh_cardiac_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_cardiac_disorder" rows="2" name="pmh_cardiac_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Diabetes Mellitus) -->
                    <tr>
                        <td>Diabetes Mellitus</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_diabetes_mellitus" name="pmh_diabetes_mellitus" value="Yes" onchange="toggleText_area('pmh_diabetes_mellitus')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_diabetes_mellitus" rows="2" name="pmh_diabetes_mellitus_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Chronic Headache/Migraine) -->
                    <tr>
                        <td>Chronic Headache / Migraine</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_chronic_headache" name="pmh_chronic_headache" value="Yes" onchange="toggleText_area('pmh_chronic_headache')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_chronic_headache" rows="2" name="pmh_chronic_headache_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Hepatitis) -->
                    <tr>
                        <td>Hepatitis</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_hepatitis" name="pmh_hepatitis" value="Yes" onchange="toggleText_area('pmh_hepatitis')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_hepatitis" rows="2" name="pmh_hepatitis_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Hypertension) -->
                    <tr>
                        <td>Hypertension</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_hypertension" name="pmh_hypertension" value="Yes" onchange="toggleText_area('pmh_hypertension')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_hypertension" rows="2" name="pmh_hypertension_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Thyroid Disorder) -->
                    <tr>
                        <td>Thyroid Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_thyroid_disorder" name="pmh_thyroid_disorder" value="Yes" onchange="toggleText_area('pmh_thyroid_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_thyroid_disorder" rows="2" name="pmh_thyroid_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Blood Disorder) -->
                    <tr>
                        <td>Blood Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_blood_disorder" name="pmh_blood_disorder" value="Yes" onchange="toggleText_area('pmh_blood_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_blood_disorder" rows="2" name="pmh_blood_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Tuberculosis) -->
                    <tr>
                        <td>Tuberculosis</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_tuberculosis" name="pmh_tuberculosis" value="Yes" onchange="toggleText_area('pmh_tuberculosis')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_tuberculosis" rows="2" name="pmh_tuberculosis_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Peptic Ulcer) -->
                    <tr>
                        <td>Peptic Ulcer</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_peptic_ulcer" name="pmh_peptic_ulcer" value="Yes" onchange="toggleText_area('pmh_peptic_ulcer')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_peptic_ulcer" rows="2" name="pmh_peptic_ulcer_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Musculoskeletal Disorder) -->
                    <tr>
                        <td>Musculoskeletal Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_musculoskeletal_disorder" name="pmh_musculoskeletal_disorder" value="Yes" onchange="toggleText_area('pmh_musculoskeletal_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_musculoskeletal_disorder" rows="2" name="pmh_musculoskeletal_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Infectious Disease) -->
                    <tr>
                        <td>Infectious Disease</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="pmh_infectious_disease" name="pmh_infectious_disease" value="Yes" onchange="toggleText_area('pmh_infectious_disease')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-pmh_infectious_disease" rows="2" name="pmh_infectious_disease_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Others) -->
                    <tr>
                        <td>Others</td>
                        <td colspan="2">
                            <textarea class="form-control" rows="2" name="pmh_others"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Second Row -->
        <div class="row">
            <div class="col">
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
                        <td>Bronchial Asthma</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_bronchial_asthma" name="fh_bronchial_asthma" value="Yes" onchange="toggleText_area('fh_bronchial_asthma')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_bronchial_asthma" rows="2" name="fh_bronchial_asthma_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Diabetes Mellitus) -->
                    <tr>
                        <td>Diabetes Mellitus</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_diabetes_mellitus" name="fh_diabetes_mellitus" value="Yes" onchange="toggleText_area('fh_diabetes_mellitus')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_diabetes_mellitus" rows="2" name="fh_diabetes_mellitus_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Thyroid Disorder) -->
                    <tr>
                        <td>Thyroid Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_thyroid_disease" name="fh_thyroid_disease" value="Yes" onchange="toggleText_area('fh_thyroid_disease')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_thyroid_disease" rows="2" name="fh_thyroid_disease_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Opthalmologic Disease) -->
                    <tr>
                        <td>Opthalmologic Disease</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_opthalmologic_disease" name="fh_opthalmologic_disease" value="Yes" onchange="toggleText_area('fh_opthalmologic_disease')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_opthalmologic_disease" rows="2" name="fh_opthalmologic_disease_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Cancer) -->
                    <tr>
                        <td>Cancer</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_cancer" name="fh_cancer" value="Yes" onchange="toggleText_area('fh_cancer')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_cancer" rows="2" name="fh_cancer_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Cardiac Disorder) -->
                    <tr>
                        <td>Cardiac Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_cardiac_disorder" name="fh_cardiac_disorder" value="Yes" onchange="toggleText_area('fh_cardiac_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_cardiac_disorder" rows="2" name="fh_cardiac_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Hypertension) -->
                    <tr>
                        <td>Hypertension</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_hypertension" name="fh_hypertension" value="Yes" onchange="toggleText_area('fh_hypertension')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_hypertension" rows="2" name="fh_hypertension_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Tuberculosis) -->
                    <tr>
                        <td>Tuberculosis</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_tuberculosis" name="fh_tuberculosis" value="Yes" onchange="toggleText_area('fh_tuberculosis')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_tuberculosis" rows="2" name="fh_tuberculosis_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Nervous Disorder) -->
                    <tr>
                        <td>Nervous Disorder</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_nervous_disorder" name="fh_nervous_disorder" value="Yes" onchange="toggleText_area('fh_nervous_disorder')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_nervous_disorder" rows="2" name="fh_nervous_disorder_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Musculoskeletal) -->
                    <tr>
                        <td>Musculoskeletal</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_musculoskeletal" name="fh_musculoskeletal" value="Yes" onchange="toggleText_area('fh_musculoskeletal')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_musculoskeletal" rows="2" name="fh_musculoskeletal_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Liver Disease) -->
                    <tr>
                        <td>Liver Disease</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_liver_disease" name="fh_liver_disease" value="Yes" onchange="toggleText_area('fh_liver_disease')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_liver_disease" rows="2" name="fh_liver_disease_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Kidney Disease) -->
                    <tr>
                        <td>Kidney Disease</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="fh_kidney_disease" name="fh_kidney_disease" value="Yes" onchange="toggleText_area('fh_kidney_disease')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-fh_kidney_disease" rows="2" name="fh_kidney_disease_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Others) -->
                    <tr>
                        <td>Others</td>
                        <td colspan="2">
                            <textarea class="form-control" rows="2" name="fh_others"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Third Row -->
        <div class="row">
            <div class="col">
                <!-- Title -->
                <div class="text-center">
                    <label class="info h3">C. Personal and Social History</label>
                </div>
                
                <!-- Personal and Social History Content -->
                <!-- First Row -->
                <div class="row row-cols-3 pt-1 mx-auto border-top border-left border-right">
                    <div class="col">
                        <label class="info h4 mb-0">
                            <input type="checkbox" class="customize-checkbox mr-1" id="smoker" name="smoker" value="Yes" onchange="toggleNumber(this, 'smoker')">
                            <span class="customize-checkbox-label">Smoker:</span>
                        </label>
                    </div>
                    <div class="col">
                        <input type="number" class="customize-input-number mr-1" id="day" name="day" disabled>
                        <span class="info customize-checkbox-label">sticks / day</span>
                    </div>
                    <div class="col">
                        <input type="number" class="customize-input-number mr-1" id="year" name="year" disabled>
                        <span class="info customize-checkbox-label">pack year/s</span>
                    </div>
                </div>
                
                <!-- Second Row -->
                <div class="row row-cols-3 pt-1 mx-auto border-bottom border-left border-right">
                    <div class="col">
                        <label class="info h4 mb-0">
                            <input type="checkbox" class="customize-checkbox mr-1" id="alcoholic" name="alcoholic" value="Yes" onchange="toggleNumber(this, 'alcoholic')">
                            <span class="customize-checkbox-label">Alcoholic:</span>
                        </label>
                    </div>
                    <div class="col">
                        <input type="number" class="customize-input-number mr-1" id="shot" name="shot" disabled>
                        <span class="info customize-checkbox-label">bottle / shots</span>
                    </div>
                    <div class="col">
                        <input type="number" class="customize-input-number mr-1" id="week" name="week" disabled>
                        <span class="info customize-checkbox-label">/week</span>
                    </div>
                </div>

                <!-- Third Row -->
                <div class="row py-1 mx-auto mt-1 border">
                    <div class="col col-sm-2">
                        <label class="info h5 mb-0">
                            <input type="checkbox" class="customize-checkbox mr-1" id="hospitalization" name="hospitalization" value="Yes" onchange="toggleNumber(this, 'hospitalization')">
                            <span class="customize-checkbox-label">Hospitalization/s:</span>
                        </label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="hospitalization_result" name="hospitalization_result" disabled>
                    </div>
                    <div class="col col-sm-2">
                        <label class="info h4 mb-0">
                            <input type="checkbox" class="customize-checkbox mr-1" id="operation" name="operation" value="Yes" onchange="toggleNumber(this, 'operation')">
                            <span class="customize-checkbox-label">Operation/s:</span>
                        </label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="operation_result" name="operation_result" disabled>
                    </div>
                </div>

                <!-- Fourth Row -->
                <div class="row py-1 mx-auto mt-1 border">
                    <div class="col">
                        <label class="info mb-0">
                            <input type="checkbox" class="customize-checkbox mr-1" id="medication" name="medication" value="Yes" onchange="toggleNumber(this, 'medication')">
                            <span class="customize-checkbox-label h4"><strong>Medications:</strong></span>
                        </label>
                        <textarea class="form-control" id="med_take" rows="2" name="med_take" disabled>Not Applicable</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="row">
            <div class="col">
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
                        <td>LNMP</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="obg_lnmp" name="obg_lnmp" value="Yes" onchange="toggleText_area('obg_lnmp')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-obg_lnmp" rows="2" name="obg_lnmp_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (OB Score) -->
                    <tr>
                        <td>OB Score</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="obg_ob_score" name="obg_ob_score" value="Yes" onchange="toggleText_area('obg_ob_score')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-obg_ob_score" rows="2" name="obg_ob_score_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Abnormal Pregnancies) -->
                    <tr>
                        <td>Abnormal Pregnancies</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="obg_abnormal_pregnancies" name="obg_abnormal_pregnancies" value="Yes" onchange="toggleText_area('obg_abnormal_pregnancies')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-obg_abnormal_pregnancies" rows="2" name="obg_abnormal_pregnancies_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Date of Last Delivery) -->
                    <tr>
                        <td>Date of Last Delivery</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="obg_last_delivery" name="obg_last_delivery" value="Yes" onchange="toggleText_area('obg_last_delivery')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-obg_last_delivery" rows="2" name="obg_last_delivery_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Breast / Uterus / Ovaries) -->
                    <tr>
                        <td>Breast / Uterus / Ovaries</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="obg_breast_uterus_ovaries" name="obg_breast_uterus_ovaries" value="Yes" onchange="toggleText_area('obg_breast_uterus_ovaries')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-obg_breast_uterus_ovaries" rows="2" name="obg_breast_uterus_ovaries_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Fifth Row -->
        <div class="row">
            <div class="col">
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
                        <td>Skin</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_skin" name="rs_skin" value="Yes" onchange="toggleText_area('rs_skin')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_skin" rows="2" name="rs_skin_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Opthalmologic) -->
                    <tr>
                        <td>Opthalmologic</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_opthalmologic" name="rs_opthalmologic" value="Yes" onchange="toggleText_area('rs_opthalmologic')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_opthalmologic" rows="2" name="rs_opthalmologic_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (ENT) -->
                    <tr>
                        <td>ENT</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_ent" name="rs_ent" value="Yes" onchange="toggleText_area('rs_ent')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_ent" rows="2" name="rs_ent_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Cardiovascular) -->
                    <tr>
                        <td>Cardiovascular</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_cardiovascular" name="rs_cardiovascular" value="Yes" onchange="toggleText_area('rs_cardiovascular')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_cardiovascular" rows="2" name="rs_cardiovascular_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Respiratory) -->
                    <tr>
                        <td>Respiratory</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_respiratory" name="rs_respiratory" value="Yes" onchange="toggleText_area('rs_respiratory')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_respiratory" rows="2" name="rs_respiratory_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Gastro-Intestinal) -->
                    <tr>
                        <td>Gastro-Intestinal</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_gastro_intestinal" name="rs_gastro_intestinal" value="Yes" onchange="toggleText_area('rs_gastro_intestinal')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_gastro_intestinal" rows="2" name="rs_gastro_intestinal_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Neuro-Psychiatric) -->
                    <tr>
                        <td>Neuro-Psychiatric</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_neuro_psychiatric" name="rs_neuro_psychiatric" value="Yes" onchange="toggleText_area('rs_neuro_psychiatric')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_neuro_psychiatric" rows="2" name="rs_neuro_psychiatric_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Hermatology) -->
                    <tr>
                        <td>Hermatology</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_hematology" name="rs_hematology" value="Yes" onchange="toggleText_area('rs_hematology')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_hematology" rows="2" name="rs_hematology_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Genitourinary) -->
                    <tr>
                        <td>Genitourinary</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_genitourinary" name="rs_genitourinary" value="Yes" onchange="toggleText_area('rs_genitourinary')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_genitourinary" rows="2" name="rs_genitourinary_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>

                    <!-- Table Body (Musculo-Skeletal) -->
                    <tr>
                        <td>Musculo-Skeletal</td>
                        <td class="text-center py-4">
                            <input type="checkbox" id="rs_musculo_skeletal" name="rs_musculo_skeletal" value="Yes" onchange="toggleText_area('rs_musculo_skeletal')" checked>
                        </td>
                        <td class="text-center">
                            <textarea class="form-control" id="findingText_area-rs_musculo_skeletal" rows="2" name="rs_musculo_skeletal_findings" disabled>Not Applicable</textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Sixth Row -->
        <div class="row row-cols-1">
            <div class="col">
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
                                <input type="number" class="physical_exam_input" id="height" name="height" required> 
                                <span>cm</span>
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
                                <input type="number" class="physical_exam_input" id="weight" name="weight" required> 
                                <span>kg</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BP -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">BP* (mm/hg):</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_bp" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_bp" style="display: none;"></span>
                            </div>
                            <div class="col text-center pb-2">
                                <input type="number" class="physical_exam_input" id="top_bp" name="top_bp" required> 
                                <span>/</span>
                                <input type="number" class="physical_exam_input" id="bot_bp" name="bot_bp" required> 
                            </div>
                        </div>
                    </div>

                    <!-- Cardiac Rate -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">Cardiac Rate*:</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_pulse" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_pulse" style="display: none;"></span>
                            </div>
                            <div class="col text-center pb-2">
                                <input type="number" class="physical_exam_input" id="pulse" name="pulse" required> 
                                <span>%</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Respiratory Rate -->
                    <div class="col border">
                        <div class="row row-cols-1">
                            <div class="col">
                                <label class="info">Respiratory Rate*:</label>
                                <span class="fas fa-arrow-up mt-1 mx-1" id="arrow_up_respiratory_rate" style="display: none;"></span>
                                <span class="fas fa-arrow-down mt-1 mx-1" id="arrow_down_respiratory_rate" style="display: none;"></span>
                            </div>
                            <div class="col text-center pb-2">
                                <input type="number" class="physical_exam_input" id="respiratory_rate" name="respiratory_rate" required> 
                                <span>%</span>
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
                                <input type="number" class="physical_exam_input" id="bmi" name="bmi" style="pointer-events: none;" readonly>
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
                                <td>General Appearance</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_general_appearance" name="pe_general_appearance" value="Yes" onchange="toggleText_area('pe_general_appearance')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_general_appearance" rows="2" name="pe_general_appearance_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Skin) -->
                            <tr>
                                <td>Skin</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_skin" name="pe_skin" value="Yes" onchange="toggleText_area('pe_skin')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_skin" rows="2" name="pe_skin_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Head and Scalp) -->
                            <tr>
                                <td>Head and Scalp</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_head_scalp" name="pe_head_scalp" value="Yes" onchange="toggleText_area('pe_head_scalp')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_head_scalp" rows="2" name="pe_head_scalp_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Eyes) -->
                            <tr>
                                <td>Eyes</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_eyes" name="pe_eyes" value="Yes" onchange="toggleNumber(this, 'pe_eyes')" checked>
                                </td>
                                <td class="text-center">
                                    <div class="row">
                                        <!-- Eyes (OD) -->
                                        <div class="col">
                                            <div class="row row-cols-1">
                                                <div class="col">
                                                    <label class="info">OD:</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="physical_exam_input" id="pe_eyes_top_od" name="pe_eyes_top_od" disabled> 
                                                    <span>/</span>
                                                    <input type="number" class="physical_exam_input" id="pe_eyes_bot_od" name="pe_eyes_bot_od" disabled> 
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
                                                    <input type="number" class="physical_exam_input" id="pe_eyes_top_os" name="pe_eyes_top_os" disabled> 
                                                    <span>/</span>
                                                    <input type="number" class="physical_exam_input" id="pe_eyes_bot_os" name="pe_eyes_bot_os" disabled> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Table Body (Corrected) -->
                            <tr>
                                <td class="text-right">Corrected</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_corrected" name="pe_corrected" value="Yes" onchange="toggleNumber(this, 'pe_corrected')" checked>
                                </td>
                                <td class="text-center">
                                    <div class="row">
                                        <!-- Corrected (OD) -->
                                        <div class="col">
                                            <div class="row row-cols-1">
                                                <div class="col">
                                                    <label class="info">OD:</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="physical_exam_input" id="pe_corrected_top_od" name="pe_corrected_top_od" disabled> 
                                                    <span>/</span>
                                                    <input type="number" class="physical_exam_input" id="pe_corrected_bot_od" name="pe_corrected_bot_od" disabled> 
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
                                                    <input type="number" class="physical_exam_input" id="pe_corrected_top_os" name="pe_corrected_top_os" disabled> 
                                                    <span>/</span>
                                                    <input type="number" class="physical_exam_input" id="pe_corrected_bot_os" name="pe_corrected_bot_os" disabled> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Table Body (Pupils) -->
                            <tr>
                                <td>Pupils</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_pupils" name="pe_pupils" value="Yes" onchange="toggleText_area('pe_pupils')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_pupils" rows="2" name="pe_pupils_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Ear, Eardrums) -->
                            <tr>
                                <td>Ear, Eardrums</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_ear_eardrums" name="pe_ear_eardrums" value="Yes" onchange="toggleText_area('pe_ear_eardrums')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_ear_eardrums" rows="2" name="pe_ear_eardrums_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Nose, Sinuses) -->
                            <tr>
                                <td>Nose, Sinuses</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_nose_sinuses" name="pe_nose_sinuses" value="Yes" onchange="toggleText_area('pe_nose_sinuses')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_nose_sinuses" rows="2" name="pe_nose_sinuses_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Mouth, Throat) -->
                            <tr>
                                <td>Mouth, Throat</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_mouth_throat" name="pe_mouth_throat" value="Yes" onchange="toggleText_area('pe_mouth_throat')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_mouth_throat" rows="2" name="pe_mouth_throat_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Neck, Thyroid) -->
                            <tr>
                                <td>Neck, Thyroid</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_neck_thyroid" name="pe_neck_thyroid" value="Yes" onchange="toggleText_area('pe_neck_thyroid')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_neck_thyroid" rows="2" name="pe_neck_thyroid_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Chest, Breast, Axilla) -->
                            <tr>
                                <td>Chest, Breast, Axilla</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_chest_breast_axilla" name="pe_chest_breast_axilla" value="Yes" onchange="toggleText_area('pe_chest_breast_axilla')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_chest_breast_axilla" rows="2" name="pe_chest_breast_axilla_findings" disabled>Not Applicable</textarea>
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
                                <td>Heart-Cardiovascular</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_heart_cardiovascular" name="pe_heart_cardiovascular" value="Yes" onchange="toggleText_area('pe_heart_cardiovascular')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_heart_cardiovascular" rows="2" name="pe_heart_cardiovascular_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Lungs-Respiratory) -->
                            <tr>
                                <td>Lungs-Respiratory</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_lungs_respiratory" name="pe_lungs_respiratory" value="Yes" onchange="toggleText_area('pe_lungs_respiratory')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_lungs_respiratory" rows="2" name="pe_lungs_respiratory_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Abdomen) -->
                            <tr>
                                <td>Abdomen</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_abdomen" name="pe_abdomen" value="Yes" onchange="toggleText_area('pe_abdomen')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_abdomen" rows="2" name="pe_abdomen_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Back, Flanks) -->
                            <tr>
                                <td>Back, Flanks</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_back_flanks" name="pe_back_flanks" value="Yes" onchange="toggleText_area('pe_back_flanks')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_back_flanks" rows="2" name="pe_back_flanks_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Anus, Rectum) -->
                            <tr>
                                <td>Anus, Rectum</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_anus_rectum" name="pe_anus_rectum" value="Yes" onchange="toggleText_area('pe_anus_rectum')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_anus_rectum" rows="2" name="pe_anus_rectum_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Genito-Urinary System) -->
                            <tr>
                                <td>Genito-Urinary System</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_genito_urinary_system" name="pe_genito_urinary_system" value="Yes" onchange="toggleText_area('pe_genito_urinary_system')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_genito_urinary_system" rows="2" name="pe_genito_urinary_system_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Inguinal, Genitals) -->
                            <tr>
                                <td>Inguinal, Genitals</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_inguinal_genitals" name="pe_inguinal_genitals" value="Yes" onchange="toggleText_area('pe_inguinal_genitals')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_inguinal_genitals" rows="2" name="pe_inguinal_genitals_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Musculo-Skeletal) -->
                            <tr>
                                <td>Musculo-Skeletal</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_musculo_skeletal" name="pe_musculo_skeletal" value="Yes" onchange="toggleText_area('pe_musculo_skeletal')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_musculo_skeletal" rows="2" name="pe_musculo_skeletal_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Extremities) -->
                            <tr>
                                <td>Extremities</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_extremities" name="pe_extremities" value="Yes" onchange="toggleText_area('pe_extremities')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_extremities" rows="2" name="pe_extremities_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Reflexes) -->
                            <tr>
                                <td>Reflexes</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_reflexes" name="pe_reflexes" value="Yes" onchange="toggleText_area('pe_reflexes')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_reflexes" rows="2" name="pe_reflexes_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>

                            <!-- Table Body (Neurological) -->
                            <tr>
                                <td>Neurological</td>
                                <td class="text-center py-4">
                                    <input type="checkbox" id="pe_neurological" name="pe_neurological" value="Yes" onchange="toggleText_area('pe_neurological')" checked>
                                </td>
                                <td class="text-center">
                                    <textarea class="form-control" id="findingText_area-pe_neurological" rows="2" name="pe_neurological_findings" disabled>Not Applicable</textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Diagnosis -->
                <div class="row mx-auto mb-2">
                    <div class="col">
                        <label class="info h3">Daignosis:</label>
                        <textarea class="form-control" name="diagnosis" row="3"></textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="position-right ml-auto my-2" style="width: 75px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
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
    <link rel="stylesheet" href="{{ asset('assets/css/record/zomproj-record-me.css') }}">
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

<!-- Checkbox -->
<script>
    //Textarea
    function toggleText_area(checkboxId) {
        var textarea = document.getElementById("findingText_area-" + checkboxId);
        var checkbox = document.getElementById(checkboxId);
        textarea.disabled = checkbox.checked;
        if (!checkbox.checked) {
            textarea.value = ""; // Clear input text
            checkbox.value = "No"; // Set checkbox value to "No"
            textarea.required = true;
        }else{
            textarea.value = "Not Applicable";
            checkbox.value = "Yes"; // Set checkbox value to "Yes"
            textarea.required = false;
        }
    }

    //Number
    function toggleNumber(checkbox, checkboxId) {
        //smoker
        const smoker_day = document.getElementById("day");
        const smoker_year = document.getElementById("year");
        //alcoholic
        const alcoholic_shot = document.getElementById("shot");
        const alcoholic_week = document.getElementById("week");
        //hospitalization
        const hospital = document.getElementById("hospitalization_result");
        //operation
        const operation = document.getElementById("operation_result");
        //medication
        const med_take = document.getElementById("med_take");
        //eyes
        const eyes_od_top = document.getElementById("pe_eyes_top_od");
        const eyes_od_bot = document.getElementById("pe_eyes_bot_od");
        const eyes_os_top = document.getElementById("pe_eyes_top_os");
        const eyes_os_bot = document.getElementById("pe_eyes_bot_os");
        //corrected
        const corrected_od_top = document.getElementById("pe_corrected_top_od");
        const corrected_od_bot = document.getElementById("pe_corrected_bot_od");
        const corrected_os_top = document.getElementById("pe_corrected_top_os");
        const corrected_os_bot = document.getElementById("pe_corrected_bot_os");

        if (checkbox.checked) {
            checkbox.value = "Yes";
            if (checkboxId === 'smoker'){
                smoker_day.disabled = false;
                smoker_year.disabled = false;
                smoker_day.required = true;
                smoker_year.required = true;
            } else if (checkboxId === 'alcoholic'){
                alcoholic_shot.disabled = false;
                alcoholic_week.disabled = false;
                alcoholic_shot.required = true;
                alcoholic_week.required = true;
            } else if (checkboxId === 'hospitalization'){
                hospital.disabled = false;
                hospital.required = true;
            } else if (checkboxId === 'operation'){
                operation.disabled = false;
                operation.required = true;
            } else if (checkboxId === 'medication'){
                med_take.disabled = false;
                med_take.required = true;
                med_take.value = "";
            } else if (checkboxId === 'pe_eyes'){
                eyes_od_top.value = "";
                eyes_od_bot.value = "";
                eyes_os_top.value = "";
                eyes_os_bot.value = "";
                eyes_od_top.disabled = true;
                eyes_od_bot.disabled = true;
                eyes_os_top.disabled = true;
                eyes_os_bot.disabled = true;
                eyes_od_top.required = false;
                eyes_od_bot.required = false;
                eyes_os_top.required = false;
                eyes_os_bot.required = false;
            } else if (checkboxId === 'pe_corrected'){
                corrected_od_top.value = "";
                corrected_od_bot.value = "";
                corrected_os_top.value = "";
                corrected_os_bot.value = "";
                corrected_od_top.disabled = true;
                corrected_od_bot.disabled = true;
                corrected_os_top.disabled = true;
                corrected_os_bot.disabled = true;
                corrected_od_top.required = false;
                corrected_od_bot.required = false;
                corrected_os_top.required = false;
                corrected_os_bot.required = false;
            }
        } else {
            checkbox.value = "No"; 
            if (checkboxId === 'smoker'){
                smoker_day.value = "";
                smoker_year.value = "";
                smoker_day.disabled = true;
                smoker_year.disabled = true;
                smoker_day.required = false;
                smoker_year.required = false;
            } else if (checkboxId === 'alcoholic'){
                alcoholic_shot.value = "";
                alcoholic_week.value = "";
                alcoholic_shot.disabled = true;
                alcoholic_week.disabled = true;
                alcoholic_shot.required = false;
                alcoholic_week.required = false;
            } else if (checkboxId === 'hospitalization'){
                hospital.value = "";
                hospital.disabled = true;
                hospital.required = false;
            } else if (checkboxId === 'operation'){
                operation.value = "";
                operation.disabled = true;
                operation.required = false;
            } else if (checkboxId === 'medication'){
                med_take.disabled = true;
                med_take.required = false;
                med_take.value = "Not Applicable";
            } else if (checkboxId === 'pe_eyes'){
                eyes_od_top.disabled = false;
                eyes_od_bot.disabled = false;
                eyes_os_top.disabled = false;
                eyes_os_bot.disabled = false;
                eyes_od_top.required = true;
                eyes_od_bot.required = true;
                eyes_os_top.required = true;
                eyes_os_bot.required = true;
            } else if (checkboxId === 'pe_corrected'){
                corrected_od_top.disabled = false;
                corrected_od_bot.disabled = false;
                corrected_os_top.disabled = false;
                corrected_os_bot.disabled = false;
                corrected_od_top.required = true;
                corrected_od_bot.required = true;
                corrected_os_top.required = true;
                corrected_os_bot.required = true;
            }
        }
    }
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

<!-- BMI Formula -->
<script>
    const heightInput = document.getElementById('height');
    const weightInput = document.getElementById('weight');
    const bmiInput = document.getElementById('bmi');
    const HW_result = document.getElementById('HW_result');

    heightInput.addEventListener('input', calculateBMI);
    weightInput.addEventListener('input', calculateBMI);

    function calculateBMI() {
        const height = parseFloat(heightInput.value) / 100; // Convert cm to meters
        const weight = parseFloat(weightInput.value);
    
        if (isNaN(height) || isNaN(weight)) {
            bmiInput.value = ''; // Clear the BMI if either height or weight is not a number
            HW_result.textContent = '';
            return;
        }
    
        const bmi = weight / (height * height);
        bmiInput.value = bmi.toFixed(2); // Display BMI with two decimal places
    
        if (bmi < 18.5) {
            HW_result.textContent = 'Underweight';
        } else if (bmi >= 18.5 && bmi <= 24.99) {
            HW_result.textContent = 'Normal weight';
        } else if (bmi >= 25 && bmi <= 29.9) {
            HW_result.textContent = 'Overweight';
        } else {
            HW_result.textContent = 'Obesity';
        }
    }
</script>
@stop