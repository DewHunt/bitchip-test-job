<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_role_id')->nullable();
            $table->string('name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email')->nullable();
            $table->text('permission')->nullable();
            $table->text('action_permission')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
