<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpravaChecklistProjekttuDva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('checklist_projektu', function($table) {
                $table->timestamp('updated_at')->nullable();
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
        $table->dropColumn('updated_at');
    });
    }
}
