<?php

use App\Models\Contact;

test('public contact endpoint returns contacts without auth', function () {
    Contact::factory()->create([
        'slug' => 'kochi',
        'branch' => 'Kochi',
        'address' => '1st Floor, SKM Tower, Kochi',
    ]);

    $response = $this->getJson('/api/v1/contacts')->assertOk();

    $this->assertSame('Kochi', $response->json('data.0.branch'));
    $this->assertSame('kochi', $response->json('data.0.slug'));
});

test('public contact endpoint filters by slug', function () {
    Contact::factory()->create([
        'slug' => 'kochi',
        'branch' => 'Kochi',
        'working_hours' => 'Mon - Sat: 9:30 AM - 6:30 PM',
    ]);

    Contact::factory()->create([
        'slug' => 'calicut',
        'branch' => 'Calicut',
        'working_hours' => 'Mon - Sat: 9:30 AM - 6:30 PM',
    ]);

    $response = $this->getJson('/api/v1/contacts?slug=kochi')->assertOk();

    $this->assertCount(1, $response->json('data'));
    $this->assertSame('Kochi', $response->json('data.0.branch'));
    $this->assertSame('kochi', $response->json('data.0.slug'));
});

test('public contact endpoint filters by branch name', function () {
    Contact::factory()->create(['slug' => 'calicut', 'branch' => 'Calicut']);

    $response = $this->getJson('/api/v1/contacts?branch=Calicut')->assertOk();

    $this->assertCount(1, $response->json('data'));
    $this->assertSame('Calicut', $response->json('data.0.branch'));
});
