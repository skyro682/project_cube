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
        DB::table('Users')->delete();
        $users = [
            [
                'username' => 'utilisateur',
                'password' => Hash::make('utilisateur'),
                'first_name' => 'utilisateur',
                'last_name' => 'utilisateur',
                'email' => 'utilisateur@cesi.fr',
                'grade_id' => 1
            ],
            [
                'username' => 'moderateur', 
                'password' => Hash::make('moderateur'), 
                'first_name' => 'moderateur', 
                'last_name' => 'moderateur', 
                'email' => 'moderateur@cesi.fr', 
                'grade_id' => 2
            ],
            [
                'username' => 'administrateur', 
                'password' => Hash::make('administrateur'), 
                'first_name' => 'administrateur', 
                'last_name' => 'administrateur', 
                'email' => 'administrateur@cesi.fr', 
                'grade_id' => 3
            ],
            [
                'username' => 'sadministrateur', 
                'password' => Hash::make('sadministrateur'), 
                'first_name' => 'sadministrateur', 
                'last_name' => 'sadministrateur', 
                'email' => 'sadministrateur@cesi.fr', 
                'grade_id' => 4
            ],
        ];
        DB::table('Users')->insert($users);
    }
}