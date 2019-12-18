<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjektyAClenove extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projekty_a_clenove', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('idproj')->index();
            $table->string('login');
            $table->unique(['idproj', 'login']);
            
           // $table->primary(['idproj', 'cislor']);
            $table->timestamps();
        });
    
        Schema::table('projekty_a_clenove', function($table) {
                 
            $table->foreign('idproj')->references('idproj')->on('projekt');
            $table->foreign('login')->references('email')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
