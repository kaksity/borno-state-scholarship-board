<?php

namespace App\Providers;

use App\Services\Implementations\AdminServiceImplementation;
use App\Services\Implementations\ApplicantBioDataServiceImplementation;
use App\Services\Implementations\ApplicantPaymentDataServiceImplementation;
use App\Services\Implementations\ApplicantQualificationDataServiceImplementation;
use App\Services\Implementations\ApplicantSchoolDataServiceImplementation;
use App\Services\Implementations\ApplicantServiceImplementation;
use App\Services\Implementations\ApplicantUploadedDocumentDataServiceImplementation;
use App\Services\Implementations\CountryServiceImplementation;
use App\Services\Implementations\DocumentTypeServiceImplementation;
use App\Services\Implementations\LgaServiceImplementation;
use App\Services\Implementations\QualificationTypeServiceImplementation;
use App\Services\Implementations\RemitaServiceImplementation;
use App\Services\Implementations\RemitaServiceTypeServiceImplementation;
use App\Services\Implementations\SchoolServiceImplementation;
use App\Services\Interfaces\AdminServiceInterface;
use App\Services\Interfaces\ApplicantBioDataServiceInterface;
use App\Services\Interfaces\ApplicantPaymentDataServiceInterface;
use App\Services\Interfaces\ApplicantQualificationDataServiceInterface;
use App\Services\Interfaces\ApplicantSchoolDataServiceInterface;
use App\Services\Interfaces\ApplicantServiceInterface;
use App\Services\Interfaces\ApplicantUploadedDocumentDataServiceInterface;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\DocumentTypeServiceInterface;
use App\Services\Interfaces\LgaServiceInterface;
use App\Services\Interfaces\QualificationTypeServiceInterface;
use App\Services\Interfaces\RemitaServiceInterface;
use App\Services\Interfaces\RemitaServiceTypeServiceInterface;
use App\Services\Interfaces\SchoolServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ApplicantServiceInterface::class,
            ApplicantServiceImplementation::class
        );
        $this->app->bind(
            LgaServiceInterface::class,
            LgaServiceImplementation::class
        );
        $this->app->bind(
            ApplicantBioDataServiceInterface::class,
            ApplicantBioDataServiceImplementation::class
        );
        $this->app->bind(
            ApplicantSchoolDataServiceInterface::class,
            ApplicantSchoolDataServiceImplementation::class
        );
        $this->app->bind(
            CountryServiceInterface::class,
            CountryServiceImplementation::class
        );
        $this->app->bind(
            QualificationTypeServiceInterface::class,
            QualificationTypeServiceImplementation::class,
        );
        $this->app->bind(
            ApplicantQualificationDataServiceInterface::class,
            ApplicantQualificationDataServiceImplementation::class
        );
        $this->app->bind(
            ApplicantUploadedDocumentDataServiceInterface::class,
            ApplicantUploadedDocumentDataServiceImplementation::class
        );
        $this->app->bind(
            DocumentTypeServiceInterface::class,
            DocumentTypeServiceImplementation::class
        );
        $this->app->bind(
            ApplicantPaymentDataServiceInterface::class,
            ApplicantPaymentDataServiceImplementation::class
        );

        $this->app->bind(
            RemitaServiceInterface::class,
            RemitaServiceImplementation::class
        );

        $this->app->bind(
            SchoolServiceInterface::class,
            SchoolServiceImplementation::class
        );

        $this->app->bind(
            AdminServiceInterface::class,
            AdminServiceImplementation::class
        );
        $this->app->bind(
            RemitaServiceTypeServiceInterface::class,
            RemitaServiceTypeServiceImplementation::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
