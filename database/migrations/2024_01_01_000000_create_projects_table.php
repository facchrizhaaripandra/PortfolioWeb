<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('excerpt');
            $table->string('project_type');
            $table->string('technologies');
            $table->string('github_link')->nullable();
            $table->string('live_demo_link')->nullable();
            $table->text('embed_code')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('preview_image_url')->nullable();
            $table->text('gallery_images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
