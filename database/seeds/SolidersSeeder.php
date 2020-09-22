<?php

use Illuminate\Database\Seeder;

class SolidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\Solider::class,10)->create();
    }
}
