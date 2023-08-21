<?php

namespace App\Providers;

use App\Repositories\Implementations\AdminRepositoryImplementation;
use App\Repositories\Implementations\ApplicantBioDataRepositoryImplementation;
use App\Repositories\Implementations\ApplicantPaymentDataRepositoryImplementation;
use App\Repositories\Implementations\ApplicantQualificationDataRepositoryImplementation;
use App\Repositories\Implementations\ApplicantRepositoryImplementation;
use App\Repositories\Implementations\ApplicantSchoolDataRepositoryImplementation;
use App\Repositories\Implementations\ApplicantUploadedDocumentDataRepositoryImplementation;
use App\Repositories\Implementations\CountryRepositoryImplementation;
use App\Repositories\Implementations\DocumentTypeRepositoryImplementation;
use App\Repositories\Implementations\LgaRepositoryImplementation;
use App\Repositories\Implementations\QualificationTypeRepositoryImplementation;
use App\Repositories\Implementations\RemitaServiceTypeRepositoryImplementation;
use App\Repositories\Implementations\SchoolRepositoryImplementation;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\ApplicantBioDataRepositoryInterface;
use App\Repositories\Interfaces\ApplicantPaymentDataRepositoryInterface;
use App\Repositories\Interfaces\ApplicantQualificationDataRepositoryInterface;
use App\Repositories\Interfaces\ApplicantRepositoryInterface;
use App\Repositories\Interfaces\ApplicantSchoolDataRepositoryInterface;
use App\Repositories\Interfaces\ApplicantUploadedDocumentDataRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\DocumentTypeRepositoryInterface;
use App\Repositories\Interfaces\LgaRepositoryInterface;
use App\Repositories\Interfaces\QualificationTypeRepositoryInterface;
use App\Repositories\Interfaces\RemitaServiceTypeRepositoryInterface;
use App\Repositories\Interfaces\SchoolRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            LgaRepositoryInterface::class,
            LgaRepositoryImplementation::class
        );

        $this->app->bind(
            ApplicantRepositoryInterface::class,
            ApplicantRepositoryImplementation::class
        );

        $this->app->bind(
            ApplicantBioDataRepositoryInterface::class,
            ApplicantBioDataRepositoryImplementation::class
        );

        $this->app->bind(
            ApplicantSchoolDataRepositoryInterface::class,
            ApplicantSchoolDataRepositoryImplementation::class
        );

        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepositoryImplementation::class
        );

        $this->app->bind(
            QualificationTypeRepositoryInterface::class,
            QualificationTypeRepositoryImplementation::class
        );

        $this->app->bind(
            ApplicantQualificationDataRepositoryInterface::class,
            ApplicantQualificationDataRepositoryImplementation::class,
        );

        $this->app->bind(
            DocumentTypeRepositoryInterface::class,
            DocumentTypeRepositoryImplementation::class
        );
        $this->app->bind(
            ApplicantUploadedDocumentDataRepositoryInterface::class,
            ApplicantUploadedDocumentDataRepositoryImplementation::class
        );
        $this->app->bind(
            ApplicantPaymentDataRepositoryInterface::class,
            ApplicantPaymentDataRepositoryImplementation::class
        );
        $this->app->bind(
            SchoolRepositoryInterface::class,
            SchoolRepositoryImplementation::class
        );
        $this->app->bind(
            AdminRepositoryInterface::class,
            AdminRepositoryImplementation::class
        );
        $this->app->bind(
            RemitaServiceTypeRepositoryInterface::class,
            RemitaServiceTypeRepositoryImplementation::class
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
