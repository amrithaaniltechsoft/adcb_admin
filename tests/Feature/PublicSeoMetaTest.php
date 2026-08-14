<?php

use App\Models\SeoMeta;

test('public seo meta endpoint returns all without auth', function () {
    SeoMeta::factory()->create([
        'page_name' => 'home',
        'meta_title' => 'Home | ADCB Consultancy',
        'meta_keywords' => 'adcb, consultancy',
    ]);

    $response = $this->getJson('/api/v1/seo-metas')->assertOk();

    $this->assertSame('home', $response->json('data.0.page_name'));
    $this->assertSame('Home | ADCB Consultancy', $response->json('data.0.meta_title'));
});

test('public seo meta endpoint filters by page name', function () {
    SeoMeta::factory()->create([
        'page_name' => 'home',
        'meta_title' => 'Home title',
    ]);

    SeoMeta::factory()->create([
        'page_name' => 'about',
        'meta_title' => 'About title',
    ]);

    $response = $this->getJson('/api/v1/seo-metas?page=about')->assertOk();

    $this->assertCount(1, $response->json('data'));
    $this->assertSame('about', $response->json('data.0.page_name'));
    $this->assertSame('About title', $response->json('data.0.meta_title'));
});
