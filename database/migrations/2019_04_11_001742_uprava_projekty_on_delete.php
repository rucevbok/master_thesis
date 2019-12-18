<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaProjektyOnDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
        Schema::table('polozka_sabl', function($table) {
            $table->dropForeign('polozka_sabl_idproj_foreign');
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
