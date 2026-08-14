<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mds_contents', function (Blueprint $table) {
            $table->string('banner_title')->nullable()->after('slug');
            $table->text('banner_description')->nullable()->after('banner_title');
            $table->string('banner_image')->nullable()->after('banner_description');
            $table->string('overview_title')->nullable()->after('banner_image');
            $table->text('overview_content')->nullable()->after('overview_title');
            $table->json('middle_banner')->nullable()->after('overview_content');
            $table->json('specialties')->nullable()->after('middle_banner');
            $table->json('countries')->nullable()->after('specialties');
        });
    }

    public function down(): void
    {
        Schema::table('mds_contents', function (Blueprint $table) {
            $table->dropColumn([
                'banner_title',
                'banner_description',
                'banner_image',
                'overview_title',
                'overview_content',
                'middle_banner',
                'specialties',
                'countries',
            ]);
        });
    }
};
