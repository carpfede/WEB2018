<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                'name' => 'Admin',
                'description' => 'Tiene acceso a todo el sistema.',
                'system' => true
            ],
            [
                'name' => 'Lider de proyecto',
                'description' => 'Encargado de organizar los tiempos del equipo, para que se cumplan los plazos pactados. ',
                'system' => true
            ],
            [
                'name' => 'Lider tecnico',
                'description' => 'Encargado de tomar las descisiones técnicas sobre la solución.',
                'system' => true
            ],
            [
                'name' => 'Analista de negocio',
                'description' => 'Encargado de hacer el relevamiento de información al cliente.',
                'system' => true
            ],
            [
                'name' => 'Desarrollador',
                'description' => 'Encargado de implementar las funcionalidades para el proyecto.',
                'system' => true
            ],
            [
                'name' => 'Tester',
                'description' => 'Encargado de realizar las pruebas de las funcionalidades antes de ser entregadas.',
                'system' => true
            ]
        );
    }
}
