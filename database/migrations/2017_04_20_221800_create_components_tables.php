<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTables extends Migration
{

    /*
    *   Creates three tables: questions about components, response for this question, votes for this response
    */
    public function up()
    {
          /*
        * Creating response votes Table
        */
       Schema::create('question_components', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id'); // id of the question
            $table->timestamps();
            $table->string('category', 50); //the type of the component. i.e.: Electrical component, chemicals,.... 
            $table->longText('component'); //The actual component. i.e: resistor, acrylic colors, Sulfer...
            $table->string('location', 100); // this the preferred location of the store. i.e: Madinet Nasr, Mohandeseen...
            $table->integer('user_id')->unsigned()->nullable(); //The user asking about the component
         
        });

        /*
        * Setting foreign keys
        */
        Schema::table('question_components', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL'); 
         });
        /*
        * Creating response Table
        */
        Schema::create('response_components', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id'); // id of the response
            $table->timestamps();
            $table->longText('response'); //The response of the user
            $table->integer('user_id')->unsigned()->nullable(); //id of the user responding to the question
            $table->integer('question_id')->unsigned()->nullable(); // id of the question being responded to
          
        });

        /*
        * Setting foreign keys
        */
        Schema::table('response_components', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');  
            $table->foreign('question_id')->references('id')->on('question_components')->onDelete('CASCADE'); 
         });


         /*
        * Creating response votes Table
        */
        Schema::create('components_response_votes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->integer('type')->unsigned(); //down vote or up vote -1 or 1
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('response_id')->unsigned()->nullable();
        });


        /*
        * Setting foreign keys
        */
        Schema::table('components_response_votes', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('response_id')->references('id')->on('response_components')->onDelete('CASCADE');
         });

    }

    /**
     * Reverse the migrations by dropping a;; the created tables ignoring any foreign keys
     *
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('response_components');
        Schema::drop('response_votes');
        Schema::drop('question_components');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
