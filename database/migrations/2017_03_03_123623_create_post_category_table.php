<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('post_category', function (Blueprint $table) {

            $table->integer('post_id')->unsigned();
            $table->smallInteger('category_id')->unsigned();

            //primary composite key
            $table->primary(['post_id', 'category_id']);
        });
        
        Schema::table('post_category', function (Blueprint $table) {
            $table->foreign('post_id')->references('post_id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')
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
        Schema::table('post_category', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['category_id']);
        });
        
        Schema::drop('post_category');
    }
}
