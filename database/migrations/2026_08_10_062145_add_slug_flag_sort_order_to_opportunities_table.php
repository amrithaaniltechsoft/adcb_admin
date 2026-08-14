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
        Schema::table('opportunities', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
            $table->string('flag')->nullable()->after('image');
            $table->unsignedInteger('sort_order')->default(0)->after('flag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropColumn(['slug', 'flag', 'sort_order']);
        });
    }
};
