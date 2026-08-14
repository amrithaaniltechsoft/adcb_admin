<?php

use App\Models\SeoMeta;
use App\Models\User;

test('admin can create seo meta', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('seo-metas.store'), [
            'page_name' => 'home',
            'meta_title' => 'Home | ADCB Consultancy',
            'meta_description' => 'Home page description.',
            'meta_keywords' => 'adcb, consultancy, home',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('seo_metas', [
        'page_name' => 'home',
        'meta_title' => 'Home | ADCB Consultancy',
    ]);
});

test('admin can update seo meta', function () {
    $user = User::factory()->create();
    $seoMeta = SeoMeta::factory()->create(['page_name' => 'about']);

    $this->actingAs($user)
        ->put(route('seo-metas.update', $seoMeta), [
            'page_name' => 'about',
            'meta_title' => 'About Us | ADCB Consultancy',
            'meta_description' => 'Updated description.',
            'meta_keywords' => 'about, adcb',
        ])
        ->assertRedirect(route('seo-metas.index'));

    $this->assertDatabaseHas('seo_metas', [
        'id' => $seoMeta->id,
        'meta_title' => 'About Us | ADCB Consultancy',
    ]);
});

test('admin can delete seo meta', function () {
    $user = User::factory()->create();
    $seoMeta = SeoMeta::factory()->create();

    $this->actingAs($user)
        ->delete(route('seo-metas.destroy', $seoMeta))
        ->assertRedirect();

    $this->assertDatabaseMissing('seo_metas', ['id' => $seoMeta->id]);
});

test('seo meta data endpoint includes all fields', function () {
    $user = User::factory()->create();
    SeoMeta::factory()->create(['page_name' => 'home']);

    $response = $this->actingAs($user)
        ->get(route('seo-metas.data'))
        ->assertOk();

    $this->assertSame('home', $response->json('data.0.page_name'));
    $this->assertArrayHasKey('meta_keywords', $response->json('data.0'));
});
