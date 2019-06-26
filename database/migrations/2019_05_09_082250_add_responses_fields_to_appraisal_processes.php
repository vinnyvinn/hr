<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponsesFieldsToAppraisalProcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appraisal_processes', function (Blueprint $table) {
            $table->longText('evaluator_response')->nullable();
            $table->longText('user_response')->nullable();
            $table->integer('evaluator_id')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appraisal_processes', function (Blueprint $table) {
            $table->dropColumn('evaluator_response');
            $table->dropColumn('user_response');
            $table->dropColumn('evaluator_id');
            $table->dropColumn('status');
        });
    }
}
