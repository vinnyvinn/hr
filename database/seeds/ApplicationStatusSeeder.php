<?php

use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status=[
        	['status'=> 'Rejected','description'=> 'Candidate Rejected','type'=>0],
        	['status'=> 'Shortlisted','description'=> 'Candidate Shortlisted','type'=>1],
        	['status'=> 'Offered','description'=> 'Candidate Employment offer made','type'=>2],
        	['status'=> 'Hired','description'=> 'Candidate Hired','type'=>3]

        ];

        foreach($status as $st){
        	Letters\Models\AppicationStatus::create($st);
        }
    	
    }
}
