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
            $table->string('profile_picture_url', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('text', 500);
            $table->string('image_url', 100)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->primary(['user_id', 'post_id']);
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->string('text', 500);
            $table->timestamps();
        });

        Schema::create('friends', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('friend_id')->constrained('users')->onDelete('cascade');
            $table->primary(['user_id', 'friend_id']);
            $table->timestamps();
        });

        Schema::create('friend_requests', function (Blueprint $table) {
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->primary(['requester_id', 'receiver_id']);
            $table->timestamps();
        });

        Schema::create('saved_posts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->primary(['user_id', 'post_id']);
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
        Schema::dropIfExists('friends');
        Schema::dropIfExists('saved_posts');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('users');
    }
};
