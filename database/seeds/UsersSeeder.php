<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolGerente = Role::where('nombre', 'Gerente')->first();
        $rolAnalista = Role::where('nombre', 'Analista')->first();

        $gerente = User::create([
            'name' => 'Jose Alonso Oviedo Monroy',
            'email' => 'admin@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $analista = User::create([
            'name' => 'Analista de operaciones',
            'email' => 'analista@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $gerente->roles()->attach($rolGerente);
        $analista->roles()->attach($rolAnalista);
    }
}
