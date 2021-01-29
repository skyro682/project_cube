<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone')->delete();

        $zone = [
            ['name' => 'Région non renseignée'],
            ['name' => 'Auvergne-Rhône-Alpes'],
            ['name' => 'Bourgogne-Franche-Comté'],
            ['name' => 'Bretagne'],
            ['name' => 'Centre-Val de Loire'],
            ['name' => 'Corse'],
            ['name' => 'Grand Est'],
            ['name' => 'Hauts-de-France'],
            ['name' => 'Île-de-France'],
            ['name' => 'Normandie'],
            ['name' => 'Nouvelle-Aquitaine'],
            ['name' => 'Occitanie'],
            ['name' => 'Pays de la Loire'],
            ['name' => 'Provence-Alpes-Côte d\'Azur'],
            ['name' => 'Guadeloupe'],
            ['name' => 'Martinique'],
            ['name' => 'Guyane'],
            ['name' => 'La Réunion'],
            ['name' => 'Mayotte'],
        ];

        DB::table('zone')->insert($zone);
    }
}
