<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->smallInteger('role_id')->unsigned();
            $table->boolean('seen')->default(false);
            $table->boolean('active')->index()->default(false);
            $table->string('activationCode', 30)->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
        
        Schema::table('users', function (Blueprint $table){
            $table->foreign('role_id')->references('role_id')->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign(['role_id']);
        });

        Schema::drop('users');
    }
}
