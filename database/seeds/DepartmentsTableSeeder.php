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
			'department' => 'Web Development', 

		]);
		Department::create([
			'department' => 'Marketing', 

		]);
		Department::create([
			'department' => 'Sales', 

		]);
		Department::create([
			'department' => 'Admin', 

		]);
		Department::create([
			'department' => 'Content',

		]);
    }
}
