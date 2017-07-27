<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->text('text');
            $table->integer('user_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->boolean('seen')->default(false);
            $table->timestamps();
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('post_id')->references('post_id')->on('posts')
                ->onDelete('cascade')
                ->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);
        });

        Schema::drop('comments');
    }
}
