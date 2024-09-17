<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Foreign key to courses table
            $table->string('title');
            $table->text('content')->nullable(); // Text content or description
            $table->string('video_url')->nullable(); // URL or path to the video
            $table->string('video_file')->nullable(); // Path to the uploaded video file
            $table->text('video_embed')->nullable(); // Embedded video content
            $table->json('additional_files')->nullable(); // JSON column for additional files
            $table->timestamps();

            // Foreign key
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
