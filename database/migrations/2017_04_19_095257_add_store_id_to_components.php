<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreIdToComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(Blueprint $table)
    {   
        Schema::table('components', function (Blueprint $table) {
           $table->integer('store_id')->references('id')->on('components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('components');
        Schema::drop('stores');
    }
}
