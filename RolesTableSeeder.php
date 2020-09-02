<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['nombre' => 'Administrador']);
        Role::create(['nombre' => 'Líder SENNOVA']);
        Role::create(['nombre' => 'Investigador']);
    }
}
