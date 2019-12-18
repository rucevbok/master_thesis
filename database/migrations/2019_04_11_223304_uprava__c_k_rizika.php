<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaCKRizika extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riziko', function($table) {
        $table->dropForeign('riziko_idproj_cislor_foreign');
        //$table->foreign('idproj')->references('idproj')->on('projekt')->onDelete('cascade');   
        });

        Schema::table('polozka_riziko', function($table) {
        //$table->dropForeign('polozka_sabl_idproj_foreign');
        $table->foreign((['idproj','cislor']))->references((['idproj','cislor']))->on('riziko')->onDelete('cascade');   
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
