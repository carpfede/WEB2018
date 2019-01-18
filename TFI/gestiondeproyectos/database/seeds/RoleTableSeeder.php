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
        $data = array(
            array(
                'name' => 'Admin',
                'description' => 'Tiene acceso a todo el sistema.',
                'system' => true),
            array(
                'name' => 'Lider de proyecto',
                'description' => 'Encargado de organizar los tiempos del equipo, para que se cumplan los plazos pactados. ',
                'system' => true),
            array(
                'name' => 'Lider tecnico',
                'description' => 'Encargado de tomar las descisiones técnicas sobre la solución.',
                'system' => true),
            array(
                'name' => 'Analista de negocio',
                'description' => 'Encargado de hacer el relevamiento de información al cliente.',
                'system' => true),
            array(
                'name' => 'Desarrollador',
                'description' => 'Encargado de implementar las funcionalidades para el proyecto.',
                'system' => true),
            array(
                'name' => 'Tester',
                'description' => 'Encargado de realizar las pruebas de las funcionalidades antes de ser entregadas.',
                'system' => true)
            );

        App\Domain\Role::insert($data);
    }
}
