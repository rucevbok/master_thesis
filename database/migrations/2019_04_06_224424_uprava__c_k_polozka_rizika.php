<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaCKPolozkaRizika extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polozka_riziko', function($table) {
            $table->index(['idproj','cislor']);
            $table->dropUnique('polozka_riziko_idproj_cislor_unique');
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //$table->dropUnique('polozka_riziko_idprojcislo');TODO
    }
}
