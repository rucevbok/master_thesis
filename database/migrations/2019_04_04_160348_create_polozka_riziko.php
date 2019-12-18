<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolozkaRiziko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polozka_riziko', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('idproj')->index();
            $table->integer('cislor')->index();
            $table->string('atribut')->index();
            $table->string('hodnota');
            $table->unique(['idproj','cislor']);
            $table->unique(['idproj','atribut']);
            $table->timestamps();
        });

        Schema::table('polozka_riziko', function($table) {
            $table->foreign(['idproj', 'atribut'])->references(['idproj', 'atribut'])->on('polozka_sabl');
            
           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polozka_riziko');
    }
}
