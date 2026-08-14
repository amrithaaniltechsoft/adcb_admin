<?php

use App\Models\Contact;
use App\Models\User;

test('admin can create a contact', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('contacts.store'), [
            'slug' => 'kochi',
            'branch' => 'Kochi',
            'address' => '1st Floor, SKM Tower, Kochi',
            'phone' => '+91 6282700600',
            'email' => 'adcbedtech@gmail.com',
            'working_hours' => 'Mon - Sat: 9:30 AM - 6:30 PM',
            'map_embed_url' => 'https://www.google.com/maps/embed?test=1',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('contacts', [
        'slug' => 'kochi',
        'branch' => 'Kochi',
        'phone' => '+91 6282700600',
    ]);
});

test('admin can update a contact', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create(['slug' => 'kochi']);

    $this->actingAs($user)
        ->put(route('contacts.update', $contact), [
            'slug' => 'kochi',
            'branch' => 'Kochi',
            'address' => '2nd Floor, New Tower, Kochi',
            'phone' => '+91 6282700601',
            'email' => 'kochi@adcb.com',
            'working_hours' => 'Mon - Sat: 10:00 AM - 7:00 PM',
            'map_embed_url' => 'https://www.google.com/maps/embed?test=2',
        ])
        ->assertRedirect(route('contacts.index'));

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'address' => '2nd Floor, New Tower, Kochi',
        'phone' => '+91 6282700601',
    ]);
});

test('admin can delete a contact', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create();

    $this->actingAs($user)
        ->delete(route('contacts.destroy', $contact))
        ->assertRedirect();

    $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
});

test('contact data endpoint includes slug and map url', function () {
    $user = User::factory()->create();
    Contact::factory()->create(['slug' => 'kochi']);

    $response = $this->actingAs($user)
        ->get(route('contacts.data'))
        ->assertOk();

    $this->assertSame('kochi', $response->json('data.0.slug'));
    $this->assertArrayHasKey('map_embed_url', $response->json('data.0'));
});
