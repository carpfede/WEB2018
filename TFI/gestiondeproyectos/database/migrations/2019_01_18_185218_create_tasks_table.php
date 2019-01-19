<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('priority');
            $table->enum('status', ['Hacer', 'EnProgreso', 'Resuelta', 'Testing', 'Cancelada']);
            $table->enum('type', ['NuevaFuncion', 'Tarea', 'Error', 'Soporte']);	        	        
            $table->string('description');
            $table->string('attachments');
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');
            $table->unsignedInteger('sprint_id');
            $table->foreign('sprint_id')->references('id')->on('sprints');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
