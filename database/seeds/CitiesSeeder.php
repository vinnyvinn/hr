<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        City::truncate();
        $inserts = [
            [
                'name' => 'Mogadishu',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Hargeisa',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Burao',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Berbera',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Borama',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Baidoa',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Beledweyne',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Bardera',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Kismaio',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Galkaio',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Jowhar',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Erigavo',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Las Anod',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Garoowe',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Badhan',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Afgooye',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Boon',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Merca',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Qoryoley',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Bosaso',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Baki',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Lughaya',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Qardho',
                'created_at' => $now,
                'updated_at' => $now
            ],

        ];
        City::insert($inserts);
    }
}