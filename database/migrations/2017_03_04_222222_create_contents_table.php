<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('content_id');
            $table->integer('post_id')->index()->unsigned();
            $table->text('text');
        });

        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('post_id')->references('post_id')->on('posts')
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
        Schema::table('contents', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
        Schema::drop('contents');
    }
}
