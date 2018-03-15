<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmountToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts',function($table){              
            $table->double('amount');
            $table->string('name');
            $table->integer('type');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts',function($table){
            $table->dropColumn('amount');
            $table->dropColumn('name');
            $table->dropColumn('type');
        });
        }
}
