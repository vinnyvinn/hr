<?php

use Illuminate\Database\Seeder;

class TravelModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TravelMode::create(
            [
                'name'=>'Public',
                'description'=>'Public transport'
            ]
        );
    }
}
