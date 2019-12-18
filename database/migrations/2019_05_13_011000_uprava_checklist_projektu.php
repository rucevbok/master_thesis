<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaChecklistProjektu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('checklist_projektu', function($table) {
                $table->integer('splneno');
                $table->string('komentar');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('checklist_projektu', function($table) {
        $table->dropColumn('splneno');
        $table->dropColumn('komentar');
    });
    }
}
