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
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'UTF8';
            $table->collation = 'utf8_general_ci';
            
            $table->bigIncrements('comment_id')->unique();
            $table->string('text');
            $table->bigInteger('author_id')->unsigned();
            
            //foreign keys
            $table->foreign('author_id')->references('user_id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function(Blueprint $table) {
           $table->dropForeign('comments_author_id_foreign'); 
        });
        
        Schema::dropIfExists('comments');
    }
}
