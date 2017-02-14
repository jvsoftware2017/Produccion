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
            $table->integer('id_client')->unsigned();
            $table->integer('id_role')->unsigned()->default(5);
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->dateTime('last_login')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->rememberToken();
            $table->timestamps(); //comment
        });
    }

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
