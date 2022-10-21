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
            $table->foreignId('userId')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('postId')->constrained('posts')->onDelete('cascade');
            $table->primary(['userId', 'postId']);
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('postId')->constrained('posts')->onDelete('cascade');
            $table->string('text', 500);
            $table->timestamps();
        });

        Schema::create('friendUsers', function (Blueprint $table) {
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('friendId')->constrained('users')->onDelete('cascade');
            $table->primary(['userId', 'friendId']);
        });

        Schema::create('savedPosts', function (Blueprint $table) {
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('postId')->constrained('posts')->onDelete('cascade');
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
