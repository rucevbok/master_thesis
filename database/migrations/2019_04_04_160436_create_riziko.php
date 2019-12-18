<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiziko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riziko', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('idproj')->index();
            $table->integer('cislor')->index();
            $table->unique(['idproj', 'cislor']);

            
           // $table->primary(['idproj', 'cislor']);
            $table->timestamps();
        });

        
    
        Schema::table('riziko', function($table) {
            
            
            $table->foreign('idproj')->references('idproj')->on('projekt');
            //$table->foreign(['idproj', 'cislor'])->references(['idproj', 'cislor'])->on('polozka_riziko');
            $table->foreign(['idproj', 'cislor'])->references(['idproj', 'cislor'])->on('polozka_riziko');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riziko');
    }
}
