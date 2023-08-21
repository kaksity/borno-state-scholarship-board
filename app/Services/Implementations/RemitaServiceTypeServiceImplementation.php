<?php

namespace App\Services\Implementations;

use App\Repositories\Interfaces\RemitaServiceTypeRepositoryInterface;
use App\Services\Interfaces\RemitaServiceTypeServiceInterface;

class RemitaServiceTypeServiceImplementation implements RemitaServiceTypeServiceInterface
{
    public function __construct(
        private RemitaServiceTypeRepositoryInterface $remitaServiceTypeRepositoryInterface
    )
    {}

    public function createRemitaServiceTypeRecord($data)
    {
        return $this->remitaServiceTypeRepositoryInterface->createRemitaServiceTypeRecord(
            $data
        );
    }
    public function getRemitaServiceTypeById($id, $relationships = [])
    {
        return $this->remitaServiceTypeRepositoryInterface->getRemitaServiceTypeById(
            $id,
            $relationships
        );
    }
    public function updateRemitaServiceTypeRecord($data, $id)
    {
        $this->remitaServiceTypeRepositoryInterface->updateRemitaServiceTypeRecord(
            $data,
            $id
        );
    }
    public function deleteRemitaServiceTypeRecord($id)
    {
        $this->remitaServiceTypeRepositoryInterface->deleteRemitaServiceTypeRecord(
            $id
        );
    }
    public function getRemitaServiceTypeFiltered($getApplicantQualificationFilterOptions, $relationships = [])
    {
        return $this->remitaServiceTypeRepositoryInterface->getRemitaServiceTypeFiltered(
            $getApplicantQualificationFilterOptions,
            $relationships
        );
    }
}
