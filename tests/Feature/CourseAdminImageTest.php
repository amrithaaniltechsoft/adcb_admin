<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin can update a course image and old file is removed', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $course = Course::create([
        'name' => 'MBBS',
        'image' => UploadedFile::fake()->image('old.jpg')->store('courses', 'public'),
    ]);

    $oldImage = $course->image;

    $this->actingAs($user)->put(route('courses.update', $course), [
        'name' => 'MBBS',
        'code' => 'MBBS',
        'title' => 'Bachelor of Medicine & Surgery',
        'image' => UploadedFile::fake()->image('new.jpg'),
    ])->assertRedirect();

    $course->refresh();

    Storage::disk('public')->assertMissing($oldImage);
    Storage::disk('public')->assertExists($course->image);
});

test('public endpoint returns absolute url for uploaded course image', function () {
    Storage::fake('public');

    Course::create([
        'name' => 'MBBS',
        'image' => UploadedFile::fake()->image('mbbs.jpg')->store('courses', 'public'),
    ]);

    $response = $this->getJson('/api/v1/courses')->assertOk();

    expect($response->json('data.0.image'))->toContain('/storage/courses/');
});
