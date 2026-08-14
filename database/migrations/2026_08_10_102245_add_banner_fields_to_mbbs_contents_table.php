<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mbbs_contents', function (Blueprint $table) {
            $table->string('banner_title')->nullable();
            $table->text('banner_description')->nullable();
            $table->string('banner_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mbbs_contents', function (Blueprint $table) {
            $table->dropColumn(['banner_title', 'banner_description', 'banner_image']);
        });
    }
};
