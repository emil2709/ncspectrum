<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overviews', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id', false); //Primarykey
            $table->integer('visit_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
            //$table->foreign('visit_id')->references('vid')->on('visits'); //Foreignkey from visitstable
            //$table->foreign('user_id')->references('uid')->on('users'); //Foreignkey from userstable
        Schema::table('overviews', function($table) {
            $table->foreign('visit_id')->references('vid')->on('visits')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('overviews');
    }
}
