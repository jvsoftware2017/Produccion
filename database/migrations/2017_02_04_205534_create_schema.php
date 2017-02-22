<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('description', ['developer', 'admin', 'client', 'reports', 'user']);
            $table->timestamps();
        });
        
        Schema::create(/**
         * @param Blueprint $table
         */
            'clients', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('id_city')->unsigned();
        	$table->string('name', 100);
        	$table->string('email');
        	$table->integer('phone');
        	$table->string('adress', 100);
        	$table->timestamps();
        });
        
        Schema::create('cities', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name', 100);
        	$table->timestamps();
        });
        
        Schema::create('plants', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('id_city')->unsigned();
        	$table->integer('id_client')->unsigned();
        	$table->string('name', 100);
        	$table->string('adress', 100);
        	$table->timestamps();
        });
        
        Schema::create('equipments', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('id_plant')->unsigned();
        	$table->integer('id_type')->unsigned();
        	$table->string('name', 100);
        	$table->string('model', 100);
        	$table->string('geolocation', 100);
        	$table->dateTime('last_event');
        	$table->timestamps();
        });
        
        
        Schema::create('events', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('id_equipment')->unsigned();
        	$table->string('name', 100);
        	$table->timestamps();
        });

        Schema::create('user_access', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('id_user')->unsigned();
        	$table->integer('id_plant')->unsigned();
        	$table->integer('id_equipment')->unsigned();
        	$table->timestamps();
        });
        
        Schema::create('types', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name', 100);
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('plants');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('measured_variables');
        Schema::dropIfExists('events');
        Schema::dropIfExists('states');
        Schema::dropIfExists('user_access');
        Schema::dropIfExists('types');
    }
}
