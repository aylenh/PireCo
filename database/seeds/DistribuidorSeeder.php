<?php

use App\Distribuidor;
use Illuminate\Database\Seeder;

class DistribuidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distribuidor::create([
            'distribuidor_local' => 'prueba', 
            'distribuidor_correo' => 'prueba', 
            'distribuidor_contacto' => 'prueba',
            'distribuidor_ubicacion' => 'prueba', 
            'distribuidor_latitude' => '-34.554974', 
            'distribuidor_longitude' => '-58.523945'
        ]);
    }
}
