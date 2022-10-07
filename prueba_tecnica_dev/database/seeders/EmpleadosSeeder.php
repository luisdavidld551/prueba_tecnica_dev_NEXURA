<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert([
            [
                'nombre' => 'Gladis Fernández',
                'email' => 'gfernandez@example.com',
                'sexo'  => 'F',
                'area_id'  => 3,
                'boletin'  => 1,
                'descripcion'  => 'Nada',
            ],
            [
                'nombre' => 'Felipe Gómez',
                'email' => 'fgomez@example.com',
                'sexo'  => 'M',
                'area_id'  => 6,
                'boletin'  => 0,
                'descripcion'  => 'Nada',
            ],
            [
                'nombre' => 'Adriana Loaiza',
                'email' => 'Aloaiza@example.com',
                'sexo'  => 'F',
                'area_id'  => 5,
                'boletin'  => 1,
                'descripcion'  => ' ',
            ],
        ]);
    }
}
