<?php

namespace App\Repositories\Implementations;

use App\Models\Applicant;
use App\Repositories\Interfaces\ApplicantRepositoryInterface;

class ApplicantRepositoryImplementation implements ApplicantRepositoryInterface
{
    public function __construct(
        private Applicant $applicant
    )
    {}

    public function createApplicantRecord($data)
    {
        return $this->applicant->create($data);
    }

    public function updateApplicantRecord($data, $id)
    {
        $this->applicant->where([
            'id' => $id
        ])->update($data);
    }
    public function getApplicantByEmailAddress($emailAddress, $relationships = [])
    {
        return $this->applicant->with($relationships)->where([
            'email' => $emailAddress
        ])->first();
    }
}
