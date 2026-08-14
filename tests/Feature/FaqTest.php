<?php

use App\Models\Faq;
use App\Models\User;

test('admin can create a faq with a category', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('faqs.store'), [
            'category' => 'Kochi',
            'question' => 'Is NEET PG counselling available in Kochi?',
            'answer' => 'Yes, ADCB offers full support for NEET PG counselling.',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('faqs', [
        'category' => 'Kochi',
        'question' => 'Is NEET PG counselling available in Kochi?',
        'answer' => 'Yes, ADCB offers full support for NEET PG counselling.',
    ]);
});

test('admin can update a faq category', function () {
    $user = User::factory()->create();
    $faq = Faq::create([
        'category' => 'Kochi',
        'question' => 'Old question?',
        'answer' => 'Old answer.',
    ]);

    $this->actingAs($user)
        ->put(route('faqs.update', $faq), [
            'category' => 'Calicut',
            'question' => 'New question?',
            'answer' => 'New answer.',
        ])
        ->assertRedirect(route('faqs.index'));

    $this->assertDatabaseHas('faqs', [
        'id' => $faq->id,
        'category' => 'Calicut',
        'question' => 'New question?',
        'answer' => 'New answer.',
    ]);
});

test('faq data endpoint includes category', function () {
    $user = User::factory()->create();
    Faq::create([
        'category' => 'Calicut',
        'question' => 'Question?',
        'answer' => 'Answer.',
    ]);

    $response = $this->actingAs($user)
        ->get(route('faqs.data'))
        ->assertOk();

    $this->assertEquals('Calicut', $response->json('data.0.category'));
});
