<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['username' => 'utilisateur', 'password' => 'utilisateur', 'first_name' => 'utilisateur', 'last_name' => 'utilisateur', 'email' => 'utilisateur@cesi.fr', 'grade_id' => 1],
            ['username' => 'moderateur', 'password' => 'moderateur', 'first_name' => 'moderateur', 'last_name' => 'moderateur', 'email' => 'moderateur@cesi.fr', 'grade_id' => 2],
            ['username' => 'administrateur', 'password' => 'administrateur', 'first_name' => 'administrateur', 'last_name' => 'administrateur', 'email' => 'administrateur@cesi.fr', 'grade_id' => 3],
            ['username' => 'sadministrateur', 'password' => 'sadministrateur', 'first_name' => 'sadministrateur', 'last_name' => 'sadministrateur', 'email' => 'sadministrateur@cesi.fr', 'grade_id' => 4],
        ];
        DB::table('Users')->insert($users);
    }
}
