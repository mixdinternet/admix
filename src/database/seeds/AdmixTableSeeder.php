<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Mixdinternet\Admix\User;

class AdmixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('roles')->truncate();
        DB::table('users')->truncate();

        $email = strtolower(str_random(6) . '@example.' . str_random(3));
        $password = str_random(8);
        User::create(['name' => 'Administrador', 'email' => $email, 'password' => bcrypt($password)]);

        $this->command->info("Usuário administrador criado.");
        $this->command->info("E-mail => $email");
        $this->command->info("Senha => $password");
    }
}
