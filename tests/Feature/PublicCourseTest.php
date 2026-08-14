<?php

use App\Models\Course;

test('public course endpoint returns all courses without auth', function () {
    Course::create(['name' => 'MBBS']);
    Course::create(['name' => 'MDS']);

    $response = $this->getJson('/api/v1/courses')->assertOk();

    $this->assertSame('MBBS', $response->json('data.0.name'));
    $this->assertSame('MDS', $response->json('data.1.name'));
    $this->assertArrayNotHasKey('action', $response->json('data.0'));
});

test('public course endpoint orders courses by id', function () {
    Course::create(['name' => 'DNB']);
    Course::create(['name' => 'MBBS']);

    $response = $this->getJson('/api/v1/courses')->assertOk();

    $this->assertSame('DNB', $response->json('data.0.name'));
    $this->assertSame('MBBS', $response->json('data.1.name'));
});

test('public course endpoint returns homepage card fields', function () {
    Course::create([
        'name' => 'MBBS',
        'code' => 'MBBS',
        'title' => 'Bachelor of Medicine & Surgery',
        'description' => 'Foundation of medical excellence.',
        'image' => '/courses/mbbs.jpg',
        'href' => '/mbbs',
        'sort_order' => 1,
        'featured' => true,
    ]);

    $response = $this->getJson('/api/v1/courses')->assertOk();

    $this->assertSame('MBBS', $response->json('data.0.code'));
    $this->assertSame('Bachelor of Medicine & Surgery', $response->json('data.0.title'));
    $this->assertSame('Foundation of medical excellence.', $response->json('data.0.description'));
    $this->assertSame('/courses/mbbs.jpg', $response->json('data.0.image'));
    $this->assertSame('/mbbs', $response->json('data.0.href'));
    $this->assertSame(1, $response->json('data.0.sort_order'));
    $this->assertTrue($response->json('data.0.featured'));
});
