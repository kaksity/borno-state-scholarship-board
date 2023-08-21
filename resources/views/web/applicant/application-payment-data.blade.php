@extends('web.applicant.layout')
@section('applicant-page-content')
<div class="bt-wizard" id="progresswizard">
    <ul class="nav nav-pills nav-fill mb-3">
        <li class="nav-item">
            <a href="{{ route('applicant.applicant-bio-data.index') }}" class="nav-link">
                Personal-Data
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('applicant.applicant-qualification-data.index')}}" class="nav-link">
                Qualifications
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('applicant.applicant-uploaded-document-data.index') }}" class="nav-link">
                Document Uploads
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('applicant.applicant-preview-data.index') }}" class="nav-link">
                Preview & Submit
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active show" id="progress-t-tab1">
            @if (session()->has('status'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if (is_null($remitaPaymentInformation))
                <form action="{{ route('applicant.applicant-payment-data.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-danger">Pay Application Fee with Remita</button>
                        </div>
                    </div>
                </form>
            @else
                <form method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h3>Applicant Information</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 alert alert-danger">
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5>Applicant Name</h5>
                                    <div>
                                        <input type="text" class="form-control" disabled placeholder="Applicant Name"
                                            value="{{ $applicant->surname }} {{ $applicant->other_names }}">
                                        @error('course_of_study')
                                        <div class="p-1 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5>Applicant Email Address</h5>
                                    <div>
                                        <input type="text" class="form-control" disabled placeholder="Applicant Name"
                                            value="{{ $applicant->email }}">
                                        @error('course_of_study')
                                        <div class="p-1 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5>Application Amount</h5>
                                    <div>
                                        <input type="text" class="form-control" disabled placeholder="Application Amount"
                                            value="N{{ $remitaPaymentInformation['amount'] }}">
                                        @error('course_of_study')
                                        <div class="p-1 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5>Generated RRR</h5>
                                    <div>
                                        <input type="text" class="form-control" id="remitaRRR" disabled placeholder="Generated RRR"
                                            value="{{ $remitaPaymentInformation['rrr']}} ( {{ $remitaPaymentInformation['transaction_status'] ?? $applicantPaymentData->status ?? 'pending' }} )">
                                        @error('course_of_study')
                                        <div class="p-1 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input name="apiVerificationHash" id="apiVerificationHash" value="{{ $remitaPaymentInformation['api_verification_hash'] }}" type="hidden">
                    <input name="publicKey" id="publicKey" value="{{ $remitaPaymentInformation['public_key'] }}" type="hidden">
                    <input name="merchantId" id="merchantId" value="{{ $remitaPaymentInformation['merchant_id'] }}" type="hidden">
                    <input name="orderId" id="orderId" value="{{ $remitaPaymentInformation['order_id'] }}" type="hidden">
                    <input name="hash" id="hash" value="{{ $remitaPaymentInformation['hash'] }}" type="hidden">
                    <input name="rrr" id="rrr"  value="{{ $remitaPaymentInformation['rrr']}}" type="hidden">
                    <button type="button" class="btn btn-danger" id="payNow">Pay Now</button>
                </form>
            @endif
        </div>
        <div class="mt-2">
            <a href="{{ route('applicant.applicant-bio-data.index') }}" class="btn btn-primary">Continue</a>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
    <script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>
    <script>
        $(() => {
            $('#payNow').click(() => {
                const merchantId = $('#merchantId').val();
                const orderId = $('#orderId').val();
                const hash = $('#hash').val();
                const rrr = $('#rrr').val();
                const publicKey = $('#publicKey').val();
                const apiVerificationHash = $('#apiVerificationHash').val()
                console.log(apiVerificationHash)
                if(merchantId != undefined && hash != undefined && rrr !=undefined) {
                    var paymentEngine = RmPaymentEngine.init({
                        key:publicKey,
                        processRrr: true,
                        extendedData: {
                            customFields: [
                                {
                                    name: "rrr",
                                    value: rrr,
                                }
                            ]
                        },
                        onSuccess: function (response) {
                            $.ajax({
                                url: `https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/${merchantId}/${rrr}/${apiVerificationHash}/status.reg`,
                                headers: {
                                    'Authorization': `remitaConsumerKey=${merchantId},remitaConsumerToken=${apiVerificationHash}`,
                                    'Content-Type': 'application/json',
                                },
                                method: 'get',
                                success: (data) => {
                                    const { message } = data
                                    console.log(data)
                                    $('#remitaRRR').val(`${rrr} (${message})`)
                                }
                            });
                            console.log('callback Successful Response', response);
                        },
                        onError: function (response) {
                            console.log('callback Error Response', response);
                        },
                        onClose: function () {
                            console.log("closed");
                        }
                    });
                    paymentEngine.showPaymentWidget();
                }
            });
            
        })
    </script>
@endsection
