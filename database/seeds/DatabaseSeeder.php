<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'AlbertoDev',
            'email' => 'alberto@dev.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('distribuidores')->insert([
            'distribuidor_local' => 'Dubai',
            'distribuidor_correo' => 'admin@admin.com',
            'distribuidor_contacto' => '998 127 7438',
            'distribuidor_imagen' => '1631652632_pexels-jack-winbow-1559486.jpg',
            'distribuidor_ubicacion' => 'Dubai Emiratos Arabes',
        ]);
            DB::table('distribuidores')->insert([
            'distribuidor_local' => 'Dubai',
            'distribuidor_correo' => 'admin@admin.com',
            'distribuidor_contacto' => '998 127 7438',
            'distribuidor_imagen' => '1631652632_pexels-jack-winbow-1559486.jpg',
            'distribuidor_ubicacion' => 'Dubai Emiratos Arabes',
        ]);
            DB::table('distribuidores')->insert([
            'distribuidor_local' => 'Dubai',
            'distribuidor_correo' => 'admin@admin.com',
            'distribuidor_contacto' => '998 127 7438',
            'distribuidor_imagen' => '1631652632_pexels-jack-winbow-1559486.jpg',
            'distribuidor_ubicacion' => 'Dubai Emiratos Arabes',
        ]);
    }
}