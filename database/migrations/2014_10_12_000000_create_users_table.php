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
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'UTF8';
            $table->collation = 'utf8_general_ci';            

            $table->bigIncrements('user_id')->unique();
            $table->string('fname', 50)->nullable();
            $table->string('lname', 50);
            $table->string('email')->unique();

            $table->string('password');
            $table->rememberToken();
            $table->string('activationCode');

            $table->boolean('isActive')->index();
            $table->boolean('isAdmin')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
