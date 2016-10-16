<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('username');
            $table->string('forename');
            $table->string('surname');
            $table->string('email');
            $table->string('password');
            $table->string('type')->default('2'); /* 1=admin; 2=regular*/
            //$table->tinyInteger('department_id')->default(1);
            $table->tinyInteger('is_active')->default('1');
            //$table->timestamp('last_login_at');
            $table->string('activation_key')->default('');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    // password: qwqwqw = $2y$10$efGa1isY3AC4Tk0Sv3JenOK5Ngwi/rYQ9XDVHh/IjQ1dH1m.VEL0u

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
