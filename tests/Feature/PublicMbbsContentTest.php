<?php

use App\Models\MbbsContent;

test('public mbbs content endpoint returns full content for a slug', function () {
    MbbsContent::create([
        'state' => 'Karnataka',
        'slug' => 'karnataka',
        'banner_title' => 'Karnataka MBBS Counselling Guide',
        'banner_description' => 'Complete information on instructions, fee structure, and document requirements for Karnataka MBBS admissions.',
        'banner_image' => '/courses/mbbs.jpg',
        'preview_title' => 'Instructions for First MBBS Admission (Academic Year 2025-26)',
        'preview_points' => "Additional documents may be required depending on your category\nMandatory affidavits and bonds before admission",
        'content' => '<h2>Fee Structure</h2><p>Details here.</p>',
        'meta_title' => 'MBBS in Karnataka | ADCB Consultancy',
        'meta_description' => 'Complete guide to Karnataka MBBS counselling.',
        'meta_keywords' => 'karnataka mbbs, neet ug',
    ]);

    $response = $this->getJson('/api/v1/mbbs-contents/karnataka')->assertOk();

    $this->assertSame('Karnataka', $response->json('data.state'));
    $this->assertSame('karnataka', $response->json('data.slug'));
    $this->assertSame('Karnataka MBBS Counselling Guide', $response->json('data.banner_title'));
    $this->assertSame('Complete information on instructions, fee structure, and document requirements for Karnataka MBBS admissions.', $response->json('data.banner_description'));
    $this->assertSame('/courses/mbbs.jpg', $response->json('data.banner_image'));
    $this->assertSame('Instructions for First MBBS Admission (Academic Year 2025-26)', $response->json('data.preview_title'));
    $this->assertSame([
        'Additional documents may be required depending on your category',
        'Mandatory affidavits and bonds before admission',
    ], $response->json('data.preview_points'));
    $this->assertSame('<h2>Fee Structure</h2><p>Details here.</p>', $response->json('data.content'));
    $this->assertSame('MBBS in Karnataka | ADCB Consultancy', $response->json('data.meta_title'));
    $this->assertSame('Complete guide to Karnataka MBBS counselling.', $response->json('data.meta_description'));
    $this->assertSame('karnataka mbbs, neet ug', $response->json('data.meta_keywords'));
});

test('public mbbs content endpoint returns 404 for unknown slug', function () {
    $this->getJson('/api/v1/mbbs-contents/nonexistent')->assertNotFound();
});
