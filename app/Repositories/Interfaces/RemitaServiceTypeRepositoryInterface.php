<?php

namespace App\Repositories\Interfaces;

interface RemitaServiceTypeRepositoryInterface
{
    public function createRemitaServiceTypeRecord($data);
    public function getRemitaServiceTypeById($id, $relationships = []);
    public function updateRemitaServiceTypeRecord($data, $id);
    public function deleteRemitaServiceTypeRecord($id);
    public function getRemitaServiceTypeFiltered($getApplicantQualificationFilterOptions, $relationships = []);
}
