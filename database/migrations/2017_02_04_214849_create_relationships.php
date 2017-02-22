<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('users', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->foreign('id_client')->references('id')->on('clients');
    		$table->foreign('id_role')->references('id')->on('roles');
    	});
    	
    	Schema::table('clients', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->foreign('id_city')->references('id')->on('cities');
    	});
    	
    	Schema::table('plants', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->foreign('id_client')->references('id')->on('clients');
    		$table->foreign('id_city')->references('id')->on('cities');
    	});
    	
    	Schema::table('equipments', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->foreign('id_plant')->references('id')->on('plants');
    		$table->foreign('id_type')->references('id')->on('types');
    	});
    	
    	
    	Schema::table('events', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->foreign('id_equipment')->references('id')->on('equipments');
    		//$table->foreign('id_state')->references('id')->on('states');
    	});
    	
    	Schema::table('user_access', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->foreign('id_user')->references('id')->on('users');
    		$table->foreign('id_plant')->references('id')->on('plants');
    		$table->foreign('id_equipment')->references('id')->on('equipments');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
