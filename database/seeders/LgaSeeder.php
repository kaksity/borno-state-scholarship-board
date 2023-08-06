<?php

namespace Database\Seeders;

use App\Models\Lga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LgaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bornoLGAs = [
            ['name' => 'Abadam'],
            ['name' => 'Askira/Uba'],
            ['name' => 'Bama'],
            ['name' => 'Bayo'],
            ['name' => 'Biu'],
            ['name' => 'Chibok'],
            ['name' => 'Damboa'],
            ['name' => 'Dikwa'],
            ['name' => 'Gubio'],
            ['name' => 'Guzamala'],
            ['name' => 'Gwoza'],
            ['name' => 'Hawul'],
            ['name' => 'Jere'],
            ['name' => 'Kaga'],
            ['name' => 'Kala/Balge'],
            ['name' => 'Konduga'],
            ['name' => 'Kukawa'],
            ['name' => 'Kwaya Kusar'],
            ['name' => 'Mafa'],
            ['name' => 'Magumeri'],
            ['name' => 'Maiduguri'],
            ['name' => 'Marte'],
            ['name' => 'Mobbar'],
            ['name' => 'Monguno'],
            ['name' => 'Ngala'],
            ['name' => 'Nganzai'],
            ['name' => 'Shani']
        ];
        
        DB::transaction(function () use ($bornoLGAs) {
            foreach ($bornoLGAs as $lga) {
                Lga::create($lga);
            }
        });
    }
}
