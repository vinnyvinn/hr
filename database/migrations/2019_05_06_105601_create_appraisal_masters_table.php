<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id');
            $table->longText('question_id');
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('status')->default(App\AppraisalMaster::STATUS_NEW);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appraisal_masters');
    }
}
