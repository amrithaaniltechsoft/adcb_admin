<?php

use App\Models\Faq;

test('public faq endpoint returns all faqs without auth', function () {
    Faq::create([
        'category' => 'Kochi',
        'question' => 'Public question?',
        'answer' => 'Public answer.',
    ]);

    $response = $this->getJson('/api/v1/faqs')->assertOk();

    $this->assertSame('Public question?', $response->json('data.0.question'));
    $this->assertSame('Public answer.', $response->json('data.0.answer'));
    $this->assertArrayNotHasKey('action', $response->json('data.0'));
});

test('public faq endpoint filters faqs by category', function () {
    Faq::create([
        'category' => 'Kochi',
        'question' => 'Kochi question?',
        'answer' => 'Kochi answer.',
    ]);

    Faq::create([
        'category' => 'Calicut',
        'question' => 'Calicut question?',
        'answer' => 'Calicut answer.',
    ]);

    $response = $this->getJson('/api/v1/faqs?category=Calicut')->assertOk();

    $this->assertCount(1, $response->json('data'));
    $this->assertSame('Calicut question?', $response->json('data.0.question'));
    $this->assertSame('Calicut', $response->json('data.0.category'));
});
