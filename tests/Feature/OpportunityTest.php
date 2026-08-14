<?php

use App\Models\Opportunity;

test('public index returns opportunities ordered by sort_order', function (): void {
    Opportunity::create([
        'slug' => 'oman',
        'title' => 'Oman',
        'description' => "OMSB examinations\nAttractive compensation",
        'image' => '/pathway/oman.jpg',
        'flag' => '/c-flag/oman.png',
        'sort_order' => 2,
    ]);

    Opportunity::create([
        'slug' => 'united-kingdom',
        'title' => 'United Kingdom',
        'description' => "PLAB / UKMLA pathway\nNHS salaries",
        'image' => '/pathway/united-kingdom.jpg',
        'flag' => '/c-flag/uk.png',
        'sort_order' => 1,
    ]);

    $response = $this->getJson('/api/v1/opportunities');

    $response->assertOk();

    $titles = collect($response->json('data'))->pluck('title')->all();

    expect($titles)->toBe(['United Kingdom', 'Oman']);
});

test('public index preserves newline-separated highlights in description', function (): void {
    Opportunity::create([
        'slug' => 'canada',
        'title' => 'Canada',
        'description' => "MCCEE / MCCQE licensing\nNDEB equivalency\nPermanent residency pathways",
        'sort_order' => 1,
    ]);

    $response = $this->getJson('/api/v1/opportunities');

    $response->assertOk();

    expect($response->json('data.0.description'))->toBe("MCCEE / MCCQE licensing\nNDEB equivalency\nPermanent residency pathways")
        ->and($response->json('data.0.slug'))->toBe('canada');
});

test('opportunity can be created via the public payload shape', function (): void {
    $opportunity = Opportunity::create([
        'slug' => 'qatar',
        'title' => 'Qatar',
        'description' => "DHP licensing\nTax-free packages",
        'image' => '/pathway/qatar.jpg',
        'flag' => '/c-flag/qatar.png',
        'sort_order' => 3,
    ]);

    expect($opportunity->slug)->toBe('qatar')
        ->and($opportunity->sort_order)->toBe(3);
});
