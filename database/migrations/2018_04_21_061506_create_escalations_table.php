<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id');
            $table->integer('recruitment_id');
            $table->integer('process_id');
            $table->longText('comment')->nullable();
            $table->integer('application_status')->nullable();
            $table->integer('esc_status')->nullable();
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
        Schema::drop('escalations');
    }
}
