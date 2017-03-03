<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'UTF8';
            $table->collation = 'utf8_general_ci';

            $table->bigInteger('article_id')->unsigned();
            $table->integer('category_id')->unsigned();

            //primary composite key
            $table->primary(['article_id', 'category_id']);

            //foreign keys
            $table->foreign('article_id')->references('article_id')->on('articles')
                ->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreign('category_id')->references('category_id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_category', function (Blueprint $table) {
            $table->dropForeign('article_category_article_id_foreign');
            $table->dropForeign('article_category_category_id_foreign');
        });
        
        Schema::dropIfExists('article_category');
    }
}
