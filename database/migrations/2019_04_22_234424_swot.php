<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Swot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swot', function (Blueprint $table) {

            $table->bigInteger('idproj')->unsigned();
            $table->string('strengths');
            $table->string('weak');
            $table->string('opport');
            $table->string('threats');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('swot', function($table) {

            $table->foreign('idproj')->references('idproj')->on('projekt')->onDelete('cascade');;
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swot');
    }
}
