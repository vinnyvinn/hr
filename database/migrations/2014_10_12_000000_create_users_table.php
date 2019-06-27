<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
						$table->increments('id');
						$table->string('first_name', 60);
						$table->string('last_name', 60);
						$table->date('birthday')->nullable();
						$table->string('gender', 1)->nullable();
						$table->string('email')->unique();
						$table->string('telephone', 20)->nullable();
						$table->string('cellphone', 20)->nullable();
						$table->string('local_address')->nullable();
						$table->string('permanent_address')->nullable();
						$table->string('employee_id')->nullable();
						$table->integer('department_id')->default(1)->nullable();
                        $table->string('blood_group')->nullable();
                        $table->string('allergies')->nullable();
                        $table->string('doctor')->nullable();
                        $table->string('family_contact')->nullable();
                        $table->string('first_guarantor')->nullable();
                        $table->string('second_guarantor')->nullable();
                        $table->string('clinic_tel')->nullable();
                        $table->string('prescription')->nullable();
                        $table->enum('disabled',['NO','YES'])->nullable();
						$table->integer('designation_item_id')->nullable()->default(1);
						$table->date('date_hired')->nullable()->default(NULL);
						$table->string('probation_from')->nullable()->default(NULL);
                        $table->string('probation_to')->nullable()->default(NULL);
						$table->decimal('salary', 10, 2)->nullable();
						$table->integer('role_id')->nullable()->default(0);
						$table->string('id_no')->nullable();
						$table->string('nssf')->nullable();
						$table->string('nhif')->nullable();
						$table->string('kra')->nullable();
						$table->string('username', 20);
						$table->string('password', 60);
						$table->string('personal_email')->nullable();
						$table->text('profile_picture');
						$table->rememberToken();
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
        Schema::drop('users');
    }
}
