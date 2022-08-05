<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public $default_img ='default/users/avatar.png';
    public $default_cover ='default/users/cover.png';
    public $default_name ='golden user';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default($this->default_name);
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->string('image')->default($this->default_img);
            $table->string('cover')->default($this->default_cover);
            $table->boolean('subscribed')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->integer('otp')->nullable();
            $table->string('fcm_token')->nullable();
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
};
