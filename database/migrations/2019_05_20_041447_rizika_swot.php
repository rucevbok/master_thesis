<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RizikaSwot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('swot', function($table) {

            $table->dropColumn('strengths');
            $table->dropColumn('weak');
            $table->dropColumn('opport');
            $table->dropColumn('threats');

           
        });

        Schema::table('swot', function($table) {

            $table->string('strengths')->nullable();
            $table->string('weak')->nullable();
            $table->string('opport')->nullable();
            $table->string('threats')->nullable();
           
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
