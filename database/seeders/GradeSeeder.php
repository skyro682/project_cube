<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grade')->insert([
            'name' => 'Utilisateur',
        ]);
        DB::table('grade')->insert([
            'name' => 'Moderateur',
        ]);
        DB::table('grade')->insert([
            'name' => 'Administrateur',
        ]);
        DB::table('grade')->insert([
            'name' => 'Super Administrateur',
        ]);
    }
}
