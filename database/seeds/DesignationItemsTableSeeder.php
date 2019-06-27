<?php

use Illuminate\Database\Seeder;
use App\DesignationItem;

class DesignationItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DesignationItem::truncate();
		DesignationItem::create([
			'designation_item' => 'HR',
			'department_id' => '1',
		]);
		DesignationItem::create([
			'designation_item' => 'SUPERVISOR',
			'department_id' => '2',
		]);
		DesignationItem::create([
			'designation_item' => 'COST ACCOUNTANT',
			'department_id' => '2',
		]);
		DesignationItem::create([
			'designation_item' => 'ACCOUNTS CLERK',
			'department_id' => '2',
		]);
		DesignationItem::create([
			'designation_item' => 'CLERK',
			'department_id' => '3',
		]);
		DesignationItem::create([
			'designation_item' => 'DISPATCH SUP.',
			'department_id' => '4',
		]);
		DesignationItem::create([
			'designation_item' => 'DISPATCH ASSISTANT',
			'department_id' => '4',
		]);
		DesignationItem::create([
			'designation_item' => 'STORE KEEPER',
			'department_id' => '5',
		]);
		DesignationItem::create([
			'designation_item' => 'IT SUP.',
			'department_id' => '6',
		]);
		DesignationItem::create([
			'designation_item' => 'IT',
			'department_id' => '6',
		]);
		DesignationItem::create([
			'designation_item' => 'SUPERVISOR',
			'department_id' => '7',
		]);
        DesignationItem::create([
            'designation_item' => 'GRADER',
            'department_id' => '7',
        ]);
        DesignationItem::create([
            'designation_item' => 'SUPERVISOR',
            'department_id' => '8',
        ]);
        DesignationItem::create([
            'designation_item' => 'LAB TECH',
            'department_id' => '8',
        ]);
        DesignationItem::create([
            'designation_item' => 'ASSISTANT',
            'department_id' => '9',
        ]);
        DesignationItem::create([
            'designation_item' => 'TFA OPERATOR',
            'department_id' => '9',
        ]);
        DesignationItem::create([
            'designation_item' => 'PASTERIZER',
            'department_id' => '9',
        ]);
        DesignationItem::create([
            'designation_item' => 'ESL OPERATOR',
            'department_id' => '9',
        ]);
        DesignationItem::create([
            'designation_item' => 'RO OPERATOR',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'REGRIGERATION',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'WELDER',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'CARPENTER',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'ETP OPERATOR',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'PLUMBER',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'BOILER OPERATOR',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'DRIVER',
            'department_id' => '11',
        ]);
        DesignationItem::create([
            'designation_item' => 'BUSINESS DEV.MANAGER',
            'department_id' => '2',
        ]);
        DesignationItem::create([
            'designation_item' => 'SALES LADY',
            'department_id' => '12',
        ]);
        DesignationItem::create([
            'designation_item' => 'CARPENTER',
            'department_id' => '10',
        ]);
        DesignationItem::create([
            'designation_item' => 'DRIVER CUM SALES',
            'department_id' => '12',
        ]);
        DesignationItem::create([
            'designation_item' => 'DRIVER DELIVERIES',
            'department_id' => '12',
        ]);
        DesignationItem::create([
            'designation_item' => 'SALESMAN',
            'department_id' => '12',
        ]);
        DesignationItem::create([
            'designation_item' => 'MERCHANDISER',
            'department_id' => '12',
        ]);
        DesignationItem::create([
            'designation_item' => 'PROMOTER',
            'department_id' => '12',
        ]);
        DesignationItem::create([
            'designation_item' => 'SALES REP',
            'department_id' => '12',
        ]);
    }
}
