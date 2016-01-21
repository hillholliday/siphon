<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialdata', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->string('message');
            $table->string('image');
            $table->softDeletes();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });


        Schema::table('socialdata', function($table) {
            $table->foreign('feed_id')->references('id')->on('feeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('networks');
    }
}
