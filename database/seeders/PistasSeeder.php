<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pista::factory(5)->make();
    }
}
