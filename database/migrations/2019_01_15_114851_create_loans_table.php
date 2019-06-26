<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('type');
            $table->string('amount');
            $table->string('monthly_repayment')->nullable();
            $table->string('installment_months')->nullable();
            $table->string('purpose')->nullable();
            $table->string('date');
            $table->string('interest_rate')->nullable();
            $table->string('approved_amount')->nullable();
            $table->integer('status')->default(0);
            $table->string('approved_date')->nullable();
            $table->string('reject_reason')->nullable();



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
        Schema::drop('loans');
    }
}
