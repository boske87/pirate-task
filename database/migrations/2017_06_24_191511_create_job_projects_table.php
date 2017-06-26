<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobProjectsTable extends Migration
{
    public function up()
    {
        // jobBoard table
        Schema::create('jobBoard', function(Blueprint $table)
        {
            $table->increments('id');
            $table ->integer('user_id')->unsigned()->default(0);
			$table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
			$table->string('title');
            $table->string('email');
			$table->text('description');
			$table->boolean('publish')->default(false);
            $table->boolean('spam')->default(false);
            $table->string('email_token')->nullable();
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
        // drop jobBoard table
        Schema::drop('jobBoard');
    }
}
