<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('measured_variables');
        Schema::create('measured_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_equipment')->unsigned();
            $table->string('name');
            $table->string('key');
            $table->string('value');
            $table->string('description');
            $table->enum('unit', ['%', 'Amps', 'Volts', 'Hr', 'C', 'Hz', 'Kw'])->nullable();
            $table->enum('type', ['Read', 'Read/Write']);
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
        Schema::dropIfExists('variables');
    }
}
