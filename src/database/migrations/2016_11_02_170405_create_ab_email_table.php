<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('ab_email', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('group');
		    $table->integer('group_id');
		    $table->string('group_designation');
		    $table->integer('group_designation_id');
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
	    Schema::dropIfExists('ab_email');
    }
}
