<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Category')->delete();

        $category = [
            ['name' => 'Art'],
            ['name' => 'Climat'],
            ['name' => 'Communiqué'],
            ['name' => 'Culture'],
            ['name' => 'Enquête'],
            ['name' => 'Environnement'],
            ['name' => 'Evènement'],
            ['name' => 'Histoire'],
            ['name' => 'International'],
            ['name' => 'Mobilisation'],
            ['name' => 'Non classé'],
            ['name' => 'Opinion'],
            ['name' => 'Politique'],
            ['name' => 'Société'],
            ['name' => 'Transport'],
        ];
        DB::table('Category')->insert($category);
    }
}
