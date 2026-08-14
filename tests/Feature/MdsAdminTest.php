<?php

use App\Models\MdsContent;
use App\Models\User;

test('mds admin page shows dynamic content fields in add and edit modals', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('mds.index'))->assertOk();
    $response->assertSee('add_banner_title', false);
    $response->assertSee('add_overview_content', false);
    $response->assertSee('add_middle_banner', false);
    $response->assertSee('add_specialties', false);
    $response->assertSee('add_countries', false);
    $response->assertSee('add_recommendation', false);
    $response->assertSee('add_meta_keywords', false);
    $response->assertDontSee('add_banner_image', false);
    $response->assertSee('edit_middle_banner', false);
    $response->assertSee('edit_specialties', false);
    $response->assertSee('edit_recommendation', false);
    $response->assertSee('edit_meta_keywords', false);
    $response->assertDontSee('edit_banner_image', false);
});

test('mds admin store persists dynamic content fields as decoded json', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('mds.store'), [
        'slug' => 'conservative-dentistry',
        'banner_title' => 'MDS Admissions & Counselling',
        'banner_description' => 'Transform your dental career.',
        'overview_title' => 'Conservative Dentistry & Endodontics',
        'overview_content' => 'A highly hands-on clinical branch.',
        'middle_banner' => json_encode(['title' => 'International Scope', 'description' => 'Open pathways abroad.']),
        'specialties' => json_encode([
            ['title' => 'Endodontics', 'image' => '/courses/mds.jpg', 'highlights' => ['Root canal treatment']],
        ]),
        'countries' => json_encode([
            ['name' => 'UAE', 'flag' => '/c-flag/uae.png', 'image' => '/pathway/uae.jpg', 'highlights' => ['Fastest pathway']],
        ]),
        'recommendation' => json_encode([
            'title' => 'Best Country Recommendation',
            'description' => 'UAE is the most practical choice.',
            'bullets' => ['Strong demand'],
            'buttonText' => 'Contact Us',
            'buttonHref' => '/contact',
            'backgroundImageSrc' => '/page-banner/uae-banner.jpg',
        ]),
        'meta_title' => 'Conservative Dentistry & Endodontics | MDS Admissions',
        'meta_description' => 'Learn about MDS specialization.',
        'meta_keywords' => 'MDS conservative dentistry',
    ])->assertRedirect(route('mds.index'));

    $content = MdsContent::where('slug', 'conservative-dentistry')->first();

    expect($content)->not->toBeNull();
    $this->assertSame('MDS Admissions & Counselling', $content->banner_title);
    $this->assertSame('/mds/Conservative Dentistry & Endodontics.jpg', $content->banner_image);
    $this->assertSame('International Scope', $content->middle_banner['title']);
    $this->assertCount(1, $content->specialties);
    $this->assertSame('UAE', $content->countries[0]['name']);
    $this->assertSame('Best Country Recommendation', $content->recommendation['title']);
    $this->assertSame('Conservative Dentistry & Endodontics | MDS Admissions', $content->meta_title);
});
