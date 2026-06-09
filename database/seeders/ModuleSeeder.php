<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['title' => 'Développement Web', 'code' => 'M201', 'MHP' => 100, 'MHS' => 20],
            ['title' => 'Bases de données', 'code' => 'M202', 'MHP' => 40, 'MHS' => 10],
            ['title' => 'Architecture des applications', 'code' => 'M203', 'MHP' => 800, 'MHS' => 15],
            ['title' => 'UX/UI et design digital', 'code' => 'M204', 'MHP' => 100, 'MHS' => 20],
            ['title' => 'Développement mobile', 'code' => 'M205', 'MHP' => 80, 'MHS' => 20],
            ['title' => 'Sécurité des applications', 'code' => 'M206', 'MHP' => 100, 'MHS' => 25],
            ['title' => 'Gestion de projet Agile', 'code' => 'M207', 'MHP' => 90, 'MHS' => 15],
            ['title' => 'Intégration continue et déploiement', 'code' => 'M208', 'MHP' => 100, 'MHS' => 20],
            ['title' => 'E-commerce et marketing digital', 'code' => 'M209', 'MHP' => 25, 'MHS' => 5],
            ['title' => 'Analyse de données et web analytics', 'code' => 'M210', 'MHP' => 45, 'MHS' => 15],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }

        // DB::table('modules')->insert($modules);
    }
}
