<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 100);
            $table->string('profilePictureUrl', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('text', 500);
            $table->string('imageUrl', 100)->nullable();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            $table->unsignedBigInteger('postId');
            $table->foreign('postId')->references('id')->on('posts');

            $table->primary(['userId', 'postId']);
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            $table->unsignedBigInteger('postId');
            $table->foreign('postId')->references('id')->on('posts');

            $table->string('text', 500);
            $table->timestamps();
        });

        Schema::create('friendUsers', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            $table->unsignedBigInteger('friendId');
            $table->foreign('friendId')->references('id')->on('users');
            $table->primary(['userId', 'friendId']);
        });

        Schema::create('savedPosts', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            $table->unsignedBigInteger('postId');
            $table->foreign('postId')->references('id')->on('posts');
            
            $table->primary(['userId', 'postId']);
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
        Schema::dropIfExists('likes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('friendUsers');
        Schema::dropIfExists('savedPosts');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('users');
    }
};
