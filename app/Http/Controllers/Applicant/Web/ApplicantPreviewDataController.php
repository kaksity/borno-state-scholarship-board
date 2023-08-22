<?php

namespace App\Http\Controllers\Applicant\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applicant\Web\BioData\UpdateApplicantBioDataRequest;
use App\Services\Interfaces\ApplicantPaymentDataServiceInterface;
use App\Services\Interfaces\RemitaServiceInterface;
use App\Services\Interfaces\ApplicantBioDataServiceInterface;
use App\Services\Interfaces\ApplicantSchoolDataServiceInterface;
use App\Services\Interfaces\ApplicantServiceInterface;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\LgaServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantPreviewDataController extends Controller
{
    public function __construct(
        private LgaServiceInterface $lgaServiceInterface,
        private CountryServiceInterface $countryServiceInterface,
        private ApplicantServiceInterface $applicantServiceInterface,
        private ApplicantBioDataServiceInterface $applicantBioDataServiceInterface,
        private ApplicantSchoolDataServiceInterface $applicantSchoolDataServiceInterface,
        private ApplicantPaymentDataServiceInterface $applicantPaymentDataServiceInterface,
        private RemitaServiceInterface $remitaServiceInterface,
    )
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $applicant = $this->applicantServiceInterface->getApplicantByEmailAddress(
            auth('applicant')->user()->email,
            [
                'applicantBioData',
                'applicantBioData.lga',
                'applicantSchoolData',
                'applicantSchoolData.country',
                'applicantQualificationData',
                'applicantQualificationData.qualificationType',
                'applicantUploadedDocumentData',
                'applicantUploadedDocumentData.documentType'
            ]
        );

        $data = [
            'applicant' => $applicant
        ];

        return view('web.applicant.preview-data')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        $loggedInApplicant = auth('applicant')->user();

        $applicantPayment = $this->applicantPaymentDataServiceInterface->getApplicantPaymentDataFiltered([
            'applicant_id' => $loggedInApplicant->id,
        ]);
        
        if (empty($applicantPayment)) {
            return redirect()->route(
                'applicant.applicant-payment-data.index'
            )->with('status', 'You must complete the payment step before proceeding');
        }

        $applicantPaymentPaymentData = $applicantPayment[0] ?? null;

        if (is_null($applicantPaymentPaymentData)) {
            return redirect()->route(
                'applicant.applicant-payment-data.index'
            )->with('status', 'You must complete the payment step before proceeding');
        }

        if ($applicantPaymentPaymentData->status === 'paid') {
            $this->applicantServiceInterface->updateApplicantRecord([
                'status' => 'Submitted'
            ], $loggedInApplicant->id);
            
            return back()->with('status', 'Application for Scholarship has been submitted successfully');
        }

        $response = $this->remitaServiceInterface->verifyPayment([
            'rrr' => $applicantPaymentPaymentData->rrr
        ]);
        
        if ($response->status === '00') {
            $this->applicantPaymentDataServiceInterface->updateApplicantPaymentDataRecord([
                'completed_payment_at' => Carbon::now(),
                'status' => 'paid'
            ], $applicantPaymentPaymentData->id);

            return back()->with('status', 'Application for Scholarship has been submitted successfully');
        }

        return redirect()->route(
            'applicant.applicant-payment-data.index'
        )->with('status', 'You must complete the payment step before proceeding');
    }
}
