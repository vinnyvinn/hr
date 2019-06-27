<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Department::truncate();
		Department::create([
			'department' => 'HR & ADMIN',

		]);
		Department::create([
			'department' => 'FINANCE',

		]);
		Department::create([
			'department' => 'MILK RECEPTION',

		]);
		Department::create([
			'department' => 'DISPATCH',

		]);
		Department::create([
			'department' => 'STORES',

		]);
        Department::create([
            'department' => 'IT',

        ]);
        Department::create([
            'department' => 'EXTENSION',

        ]);
        Department::create([
            'department' => 'QUALITY ASSURANCE',

        ]);
        Department::create([
            'department' => 'PRODUCTION',

        ]);
        Department::create([
            'department' => 'MAINTENANCE',

        ]);
        Department::create([
            'department' => 'LOGISTICS',

        ]);
        Department::create([
            'department' => 'BUSINESS DEV.MANAGER',

        ]);
        Department::create([
            'department' => 'SALES & MARKETING',

        ]);

    }
}
