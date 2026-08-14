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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('code')->nullable()->after('name');
            $table->string('title')->nullable()->after('code');
            $table->text('description')->nullable()->after('title');
            $table->string('image')->nullable()->after('description');
            $table->string('href')->nullable()->after('image');
            $table->integer('sort_order')->nullable()->after('href');
            $table->boolean('featured')->default(false)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['code', 'title', 'description', 'image', 'href', 'sort_order', 'featured']);
        });
    }
};
