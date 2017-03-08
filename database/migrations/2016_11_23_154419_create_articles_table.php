<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'UTF8';
            $table->collation = 'utf8_general_ci';
            
            $table->bigIncrements('article_id')->unique();
            $table->string('title', 100);
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('views')->unsigned();
            $table->timestamps();
            
            //foreign keys
            $table->foreign('author_id')->references('user_id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_author_id_foreign');
        });

        Schema::drop('articles');
    }
}
