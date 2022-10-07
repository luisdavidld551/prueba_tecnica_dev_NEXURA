<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['nombre' => 'Administración'],
            ['nombre' => 'Ingeniería'],
            ['nombre' => 'Ventas'],
            ['nombre' => 'Proyectos'],
            ['nombre' => 'Producción'],
            ['nombre' => 'Calidad'],
        ]);
    }
}
