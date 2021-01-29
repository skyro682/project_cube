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
        DB::table('grade')->delete();

        DB::table('grade')->insert([
            ['id' => 1, 'name' => 'Utilisateur'],
            ['id' => 2, 'name' => 'Moderateur'],
            ['id' => 3, 'name' => 'Administrateur'],
            ['id' => 4, 'name' => 'Super Administrateur'],
        ]);
    }
}
