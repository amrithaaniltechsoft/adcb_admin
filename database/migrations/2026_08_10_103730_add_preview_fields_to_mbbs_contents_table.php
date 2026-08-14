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
            $table->string('preview_title')->nullable();
            $table->text('preview_points')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mbbs_contents', function (Blueprint $table) {
            $table->dropColumn(['preview_title', 'preview_points']);
        });
    }
};
