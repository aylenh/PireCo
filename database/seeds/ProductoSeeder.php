<?php

use App\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'imagen'                => url('storage/productos/bidon.jpeg'),
            'producto_botella'      => 'Bidon', 
            'producto_descartable'  => 'retornable', 
            'producto_litros'       => '20', 
            'producto_precio'       => '300'
        ]);

        Producto::create([
            'imagen'                => url('storage/productos/bidon.jpeg'),
            'producto_botella'      => 'Bidon', 
            'producto_descartable'  => 'retornable', 
            'producto_litros'       => '10', 
            'producto_precio'       => '150'
        ]);

        Producto::create([
            'imagen'                => url('storage/productos/botella-1l.jpeg'),
            'producto_botella'      => 'Botella', 
            'producto_descartable'  => 'descartable', 
            'producto_litros'       => '1', 
            'producto_precio'       => '50'
        ]);
    }
}
