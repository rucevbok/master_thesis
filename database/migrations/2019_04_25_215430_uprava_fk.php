<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::table('projekty_a_clenove', function(Blueprint $table){
            $table->dropForeign('projekty_a_clenove_idproj_foreign');


        });
        
        Schema::table('projekt', function(Blueprint $table){
            $table->foreign('idproj')
                  ->references('idproj')->on('projekty_a_clenove')
                  ->onDelete('cascade');
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
