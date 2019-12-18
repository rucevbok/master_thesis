<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Checklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->bigInteger('idproj')->unsigned();
            $table->integer('poradi');
            $table->string('polozka')->default('');
            $table->string('komentar')->default('');
            $table->boolean('splneno')->default(0);
            $table->index(['idproj', 'poradi']);

            $table->timestamps();
        });

        Schema::table('checklist', function($table) {
       
            $table->foreign('idproj')->references('idproj')->on('projekt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklist');
    }
}
