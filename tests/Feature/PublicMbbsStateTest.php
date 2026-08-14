<?php

use App\Models\MbbsContent;

test('public mbbs states endpoint returns states without auth', function () {
    MbbsContent::create([
        'state' => 'Kerala',
        'slug' => 'kerala',
    ]);

    MbbsContent::create([
        'state' => 'Karnataka',
        'slug' => 'karnataka',
    ]);

    $response = $this->getJson('/api/v1/mbbs-states')->assertOk();

    $this->assertSame('Kerala', $response->json('data.0.state'));
    $this->assertSame('kerala', $response->json('data.0.slug'));
    $this->assertSame('Karnataka', $response->json('data.1.state'));
    $this->assertArrayNotHasKey('action', $response->json('data.0'));
    $this->assertArrayNotHasKey('content', $response->json('data.0'));
});
