<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Hash::make('utilisateur');
        $mod = Hash::make('moderateur');
        $admin = Hash::make('administrateur');
        $sadmin = Hash::make('sadministrateur');
        
        DB::table('Users')->delete();
        $users = [
            ['username' => 'utilisateur', 'password' => $user, 'first_name' => 'utilisateur', 'last_name' => 'utilisateur', 'email' => 'utilisateur@cesi.fr', 'grade_id' => 1],
            ['username' => 'moderateur', 'password' => $mod, 'first_name' => 'moderateur', 'last_name' => 'moderateur', 'email' => 'moderateur@cesi.fr', 'grade_id' => 2],
            ['username' => 'administrateur', 'password' => $admin, 'first_name' => 'administrateur', 'last_name' => 'administrateur', 'email' => 'administrateur@cesi.fr', 'grade_id' => 3],
            ['username' => 'sadministrateur', 'password' => $sadmin, 'first_name' => 'sadministrateur', 'last_name' => 'sadministrateur', 'email' => 'sadministrateur@cesi.fr', 'grade_id' => 4],
        ];
        DB::table('Users')->insert($users);
    }
}
Hash::make();