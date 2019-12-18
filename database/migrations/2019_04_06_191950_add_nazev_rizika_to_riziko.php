<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNazevRizikaToRiziko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riziko', function (Blueprint $table) {
             $table->string('nazev_rizika',150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riziko', function (Blueprint $table) {
            $table->dropColumn('nazev_rizika');
        });
    }
}
