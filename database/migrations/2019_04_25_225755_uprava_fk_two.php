<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaFkTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polozka_riziko', function($table)
        {
            $table->dropForeign('polozka_riziko_idproj_atribut_foreign');
            $table->dropForeign('polozka_riziko_idproj_cislor_foreign');
        });
        Schema::table('polozka_sabl', function($table)
        {
            $table->dropForeign('polozka_sabl_atribut_foreign');
            $table->dropForeign('polozka_sabl_idproj_foreign');
        });
        Schema::table('projekt', function($table)
        {
            $table->dropForeign('projekt_idproj_foreign');
        });
        Schema::table('projekty_a_clenove', function($table)
        {
            $table->dropForeign('projekty_a_clenove_login_foreign');
        });
        Schema::table('riziko', function($table)
        {
            $table->dropForeign('riziko_idproj_foreign');
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
