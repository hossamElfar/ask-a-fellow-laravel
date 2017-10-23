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
        Schema::create('components', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->text('contact_info');
            $table->text('price');
            $table->string('image_path');
            $table->boolean('accepted');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('creator_id')->unsigned()->index();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('component_categories')->onDelete('cascade');
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
    }
}
