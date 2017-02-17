<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id', false);
            $table->integer('user_id')->unsigned();
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('statuses', function($table) {
            $table->foreign('user_id')->references('uid')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('statuses');
        //Schema::dropIfExists('users');
    }
}