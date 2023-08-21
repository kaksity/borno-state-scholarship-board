<?php

namespace App\Services\Interfaces;

interface RemitaServiceTypeServiceInterface
{
    public function createRemitaServiceTypeRecord($data);
    public function getRemitaServiceTypeById($id, $relationships = []);
    public function updateRemitaServiceTypeRecord($data, $id);
    public function deleteRemitaServiceTypeRecord($id);
    public function getRemitaServiceTypeFiltered($getApplicantQualificationFilterOptions, $relationships = []);
}
