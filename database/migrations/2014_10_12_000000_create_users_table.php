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
						$table->date('birthday');
						$table->string('gender', 1);
						$table->string('email')->unique();
						$table->string('telephone', 20);
						$table->string('cellphone', 20);
						$table->string('local_address');
						$table->string('permanent_address');
						$table->string('employee_id');
						$table->integer('department_id');
                        $table->string('blood_group');
                        $table->string('allergies');
                        $table->string('doctor');
                        $table->string('family_contact');
                        $table->string('first_guarantor')->nullable();
                        $table->string('second_guarantor')->nullable();
                        $table->string('clinic_tel');
                        $table->string('prescription');
                        $table->enum('disabled',['NO','YES']);
						$table->integer('designation_item_id');
						$table->date('date_hired')->nullable()->default(NULL);
						$table->string('probation_from')->nullable()->default(NULL);
                        $table->string('probation_to')->nullable()->default(NULL);
						$table->decimal('salary', 10, 2);
						$table->integer('role_id');
						$table->string('id_no')->nullable();
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
