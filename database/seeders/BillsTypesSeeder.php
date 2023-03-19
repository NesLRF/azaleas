<?php

namespace Database\Seeders;

use App\Models\BillsType;
use Illuminate\Database\Seeder;

class BillsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Luz'],
            ['name' => 'Teléfono'],
            ['name' => 'Seguridad'],
            ['name' => 'Agua'],
            ['name' => 'Basura'],
            ['name' => 'Áreas verdes'],
            ['name' => 'Gastos de limpieza de terceros'],
            ['name' => 'Caceta'],
            ['name' => 'Candados'],
            ['name' => 'Papelería'],
            ['name' => 'Extras'],

        ];

        foreach($types as $type){
            BillsType::create($type);
        }
    }
}
