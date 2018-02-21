<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToLabs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labs',function($table){
              
            $table->string('address');
            $table->string('date');
            $table->integer('contact');

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labs',function($table){
            $table->dropColumn('address');
            $table->dropColumn('date');
            $table->dropColumn('contact');
       });
    }
}
