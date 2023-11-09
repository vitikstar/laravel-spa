<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('text', 1000);
            $table->unsignedBigInteger('parent_comment_id');
            $table->timestamps();

            // Foreign key relationship
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('file')->nullable();

            // Indexes
            $table->index('user_id');
            $table->index('parent_comment_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
