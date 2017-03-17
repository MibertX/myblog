<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('post_id')->unique();
            $table->string('title', 250)->index();
            $table->integer('user_id')->unsigned();
            $table->text('preview');
            $table->integer('content_id')->unsigned();
            $table->boolean('seen')->default(false);
            $table->boolean('active')->default(true)->index();
            $table->integer('views')->default(0)->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('content_id')->references('content_id')->on('contents')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['content_id']);
        });

        Schema::drop('posts');
    }
}
