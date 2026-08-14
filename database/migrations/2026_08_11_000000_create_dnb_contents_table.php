<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dnb_contents', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title')->nullable();
            $table->text('banner_description')->nullable();
            $table->string('intro_title')->nullable();
            $table->text('intro_description')->nullable();
            $table->longText('specialties')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dnb_contents');
    }
};
