<?php

namespace App\Repositories\Implementations;

use App\Models\RemitaServiceType;
use App\Repositories\Interfaces\RemitaServiceTypeRepositoryInterface;

class RemitaServiceTypeRepositoryImplementation implements RemitaServiceTypeRepositoryInterface
{
    public function __construct(
        private RemitaServiceType $remitaServiceType
    )
    {}

    public function createRemitaServiceTypeRecord($data)
    {
        return $this->remitaServiceType->create($data);
    }

    public function deleteRemitaServiceTypeRecord($id)
    {
        $this->remitaServiceType->where([
            'id' => $id
        ])->delete();
    }
    public function getRemitaServiceTypeById($id, $relationships = [])
    {
        return $this->remitaServiceType->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function updateRemitaServiceTypeRecord($data, $id)
    {
        $this->remitaServiceType->where([
            'id' => $id
        ])->update($data);
    }

    public function getRemitaServiceTypeFiltered($getRemitaServiceTypeFilterOptions, $relationships = [])
    {
        $programme = $getRemitaServiceTypeFilterOptions['programme'] ?? null;
        $isForeign = $getRemitaServiceTypeFilterOptions['is_foreign'] ?? null;

        return $this->remitaServiceType->with(
            $relationships
        )->when($programme, function($model, $programme) {
            $model->where([
                'programme' => $programme
            ]);
        })->when($isForeign, function ($model, $isForeign) {
            dd($isForeign);
            $model->where([
                'is_foreign' => $isForeign
            ]);
        })->get();
    }
}
