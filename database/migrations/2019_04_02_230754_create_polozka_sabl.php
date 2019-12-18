<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolozkaSabl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polozka_sabl', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->bigInteger('idproj')->unsigned();
            $table->string('atribut',120)->index();
            $table->unique(['idproj', 'atribut']);
            $table->timestamps();
        });

        Schema::table('polozka_sabl', function($table) {
       
            $table->foreign('idproj')->references('idproj')->on('projekt');
            $table->foreign('atribut')->references('atribut')->on('katalog');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polozka_sabl');
    }
}
