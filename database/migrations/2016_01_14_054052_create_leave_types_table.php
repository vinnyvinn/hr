<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('leave_type');
            $table->string('selected_by')->nullable();
            $table->string('backstopper_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('gender')->nullable();
            $table->string('count_start_half_day')->nullable();
            $table->string('count_end_half_day')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('staff_type_id')->nullable();
            $table->integer('carried_forward')->default(0);
            $table->integer('encashed')->default(0);
            $table->softDeletes();
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
        Schema::drop('leave_types');
    }
}
