<?php

namespace Database\Seeders;

use App\Models\RemitaServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemitaServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $remitaServiceTypes = [
            [
                'programme' => 'Undergraduate',
                'amount' => '825',
                'value' => '7190990581',
                'is_foreign' => '0',
            ],
            [
                'programme' => 'Undergraduate',
                'amount' => '825',
                'value' => '7190990581',
                'is_foreign' => '1',
            ],
            [
                'programme' => 'Masters',
                'amount' => '1750',
                'value' => '10388847341',
                'is_foreign' => '0',
            ],
            [
                'programme' => 'Masters',
                'amount' => '2750',
                'value' => '10350905830',
                'is_foreign' => '1',
            ],
            [
                'programme' => 'Doctorate',
                'amount' => '2750',
                'value' => '10350905830',
                'is_foreign' => '0',
            ],
            [
                'programme' => 'Doctorate',
                'amount' => '2750',
                'value' => '10350905830',
                'is_foreign' => '1',
            ],
        ];

        DB::transaction(function() use ($remitaServiceTypes){
            foreach ($remitaServiceTypes as $remitaServiceType) {
                RemitaServiceType::create($remitaServiceType);
            }
        });
    }
}
