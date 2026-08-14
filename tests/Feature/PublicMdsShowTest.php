<?php

use App\Models\MdsContent;

test('public mds show endpoint returns dynamic content fields', function () {
    MdsContent::create([
        'title' => 'Conservative Dentistry & Endodontics',
        'slug' => 'conservative-dentistry',
        'banner_title' => 'MDS Admissions & Counselling',
        'banner_description' => 'Transform your dental career with expert MDS counselling.',
        'banner_image' => '/mds/Conservative Dentistry & Endodontics.jpg',
        'overview_title' => 'Conservative Dentistry & Endodontics',
        'overview_content' => 'A highly hands-on clinical branch.',
        'middle_banner' => [
            'title' => 'International Scope',
            'description' => 'Your MDS degree can open pathways abroad.',
        ],
        'specialties' => [
            ['title' => 'Endodontics', 'image' => '/courses/mds.jpg', 'highlights' => ['Root canal treatment']],
        ],
        'countries' => [
            ['name' => 'UAE', 'flag' => '/c-flag/uae.png', 'image' => '/pathway/uae.jpg', 'highlights' => ['Fastest pathway']],
        ],
        'recommendation' => [
            'title' => 'Best Country Recommendation',
            'description' => 'UAE is the most practical choice.',
            'bullets' => ['Strong demand'],
            'buttonText' => 'Contact Us',
            'buttonHref' => '/contact',
            'backgroundImageSrc' => '/page-banner/uae-banner.jpg',
        ],
        'meta_title' => 'Conservative Dentistry & Endodontics | MDS Admissions',
        'meta_description' => 'Learn about Conservative Dentistry MDS specialization and global licensing pathways.',
        'meta_keywords' => 'MDS conservative dentistry, MDS admission',
    ]);

    $response = $this->getJson('/api/v1/mds/conservative-dentistry')->assertOk();

    $this->assertSame('conservative-dentistry', $response->json('data.slug'));
    $this->assertSame('MDS Admissions & Counselling', $response->json('data.banner_title'));
    $this->assertSame('Conservative Dentistry & Endodontics', $response->json('data.overview_title'));
    $this->assertSame('International Scope', $response->json('data.middle_banner.title'));
    $this->assertCount(1, $response->json('data.specialties'));
    $this->assertCount(1, $response->json('data.countries'));
    $this->assertSame('Best Country Recommendation', $response->json('data.recommendation.title'));
    $this->assertSame('Conservative Dentistry & Endodontics | MDS Admissions', $response->json('data.meta_title'));
});

test('public mds index endpoint returns preview fields', function () {
    MdsContent::create([
        'title' => 'Conservative Dentistry & Endodontics',
        'slug' => 'conservative-dentistry',
        'banner_title' => 'MDS Admissions & Counselling',
        'banner_description' => 'Transform your dental career with expert MDS counselling.',
        'overview_content' => 'Conservative Dentistry & Endodontics is one of the most sought-after clinical branches in MDS.',
        'specialties' => [
            ['title' => 'Endodontics', 'image' => '/courses/mds.jpg', 'highlights' => ['Root canal treatment', 'Aesthetic restorations']],
        ],
    ]);

    $response = $this->getJson('/api/v1/mds')->assertOk();

    $this->assertCount(1, $response->json('data'));
    $this->assertSame('conservative-dentistry', $response->json('data.0.slug'));
    $this->assertSame('Conservative Dentistry & Endodontics', $response->json('data.0.title'));
    $this->assertSame('MDS Admissions & Counselling', $response->json('data.0.banner_title'));
    $this->assertSame('Conservative Dentistry & Endodontics is one of the most sought-after clinical branches in MDS.', $response->json('data.0.overview_content'));
    $this->assertSame('Key Focus Areas', $response->json('data.0.preview_title'));
    $this->assertSame([
        'Root canal treatment',
        'Aesthetic restorations',
    ], $response->json('data.0.preview_points'));
});

test('public mds show endpoint returns 404 for unknown slug', function () {
    $this->getJson('/api/v1/mds/non-existent-specialty')->assertNotFound();
});
