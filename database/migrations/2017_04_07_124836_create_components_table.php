<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('picture');
            $table->string('description');
            $table->decimal('price', 5, 2)->unsigned();
            $table->integer('phone_number')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
        //
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
