<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Applicant\Web\ApplicantBioDataController;
use App\Http\Controllers\Applicant\Web\ApplicantPaymentDataController;
use App\Http\Controllers\Applicant\Web\ApplicantPreviewDataController;
use App\Http\Controllers\Applicant\Web\ApplicantQualificationDataController;
use App\Http\Controllers\Applicant\Web\ApplicantSchoolDataController;
use App\Http\Controllers\Applicant\Web\ApplicantUploadedDocumentDataController;
use App\Http\Controllers\Applicant\Web\Authentication\ChangePasswordController;
use App\Http\Controllers\Applicant\Web\Authentication\LoginController;
use App\Http\Controllers\Applicant\Web\Authentication\LogoutController;
use App\Http\Controllers\Applicant\Web\Authentication\RegistrationController;
use App\Http\Controllers\Applicant\Web\Authentication\ResetPasswordController;

Route::group([], function () {
    Route::group(['prefix' => 'authentication'], function () {
        Route::resource('/registration', RegistrationController::class, [
            'names' => [
                'index' => 'applicant.registration.index',
                'store' => 'applicant.registration.store'
            ]
        ]);

        Route::resource('/login', LoginController::class, [
            'names' => [
                'index' => 'applicant.login.index',
                'store' => 'applicant.login.store'
            ],
        ]);
        Route::resource('/reset-password', ResetPasswordController::class, [
            'names' => [
                'index' => 'applicant.reset-password.index',
                'store' => 'applicant.reset-password.store'
            ]
        ]);

        Route::resource('/logout', LogoutController::class, [
            'names' => [
                'store' => 'applicant.logout.store'
            ]
        ]);

        Route::resource('/change-password', ChangePasswordController::class, [
            'index' => 'applicant.change-password.index',
            'store' => 'applicant.change-password.store'
        ])->middleware('auth:applicant');
    });
    Route::group(['middleware' => ['auth:applicant']], function () {
        Route::group(['middleware' => ['verify.payment.status']], function () {
            Route::resource('/bio-data', ApplicantBioDataController::class, [
                'names' => [
                    'index' => 'applicant.applicant-bio-data.index',
                    'store' => 'applicant.applicant-bio-data.store',
                ]
            ]);

            Route::resource('/qualification-data', ApplicantQualificationDataController::class, [
                'names' => [
                    'index' => 'applicant.applicant-qualification-data.index',
                    'store' => 'applicant.applicant-qualification-data.store',
                    'destroy' => 'applicant.applicant-qualification-data.destroy',
                ]
            ]);

            Route::resource('uploaded-document-data', ApplicantUploadedDocumentDataController::class, [
                'names' => [
                    'index' => 'applicant.applicant-uploaded-document-data.index',
                    'store' => 'applicant.applicant-uploaded-document-data.store',
                    'destroy' => 'applicant.applicant-uploaded-document-data.destroy',
                ]
            ]);
            Route::resource('/preview', ApplicantPreviewDataController::class, [
                'names' => [
                    'index' => 'applicant.applicant-preview-data.index',
                    'store' => 'applicant.applicant-preview-data.store',
                    'destroy' => 'applicant.applicant-preview-data.destroy',
                ]
            ]);
        });

        Route::resource('payment-data', ApplicantPaymentDataController::class, [
            'names' => [
                'index' => 'applicant.applicant-payment-data.index',
                'store' => 'applicant.applicant-payment-data.store',
            ]
        ]);
    });
});
