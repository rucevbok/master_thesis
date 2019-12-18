<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaFkThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polozka_riziko', function($table) {
            $table->foreign((['idproj','cislor']))->references((['idproj','cislor']))->on('riziko')->onDelete('cascade');   
            $table->foreign((['idproj','atribut']))->references((['idproj','atribut']))->on('polozka_sabl')->onDelete('cascade');   
        });

        Schema::table('polozka_sabl', function($table) {
            $table->foreign('atribut')->references('atribut')->on('katalog')->onDelete('cascade');   
            $table->foreign('idproj')->references('idproj')->on('projekt')->onDelete('cascade');   
            });

        Schema::table('projekty_a_clenove', function($table) {
            $table->foreign('login')->references('email')->on('users')->onDelete('cascade');   
            $table->foreign('idproj')->references('idproj')->on('projekt')->onDelete('cascade');   
            });

        Schema::table('riziko', function($table) {
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
        //
    }
}
