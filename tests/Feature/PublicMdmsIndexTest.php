<?php

use App\Models\MdmsContent;

test('public mdms index endpoint returns state previews without auth', function () {
    MdmsContent::create([
        'state_slug' => 'kerala',
        'banner_title' => 'Kerala MD/MS Counselling Guide',
        'banner_description' => 'Complete information on eligibility, CAP counselling, reservation, fee structure, and expert guidance for Kerala MD/MS admissions.',
        'title' => 'Kerala MD/MS',
        'subtitle' => 'Complete Counselling Guide',
        'sections' => [
            [
                'id' => 'A',
                'label' => 'A. Introductions, Duration, Fees',
                'questions' => ['Who is eligible to apply for Kerala MD/MS State Quota counselling through NEET PG 2025?'],
            ],
        ],
    ]);

    $response = $this->getJson('/api/v1/mdms')->assertOk();

    $this->assertSame('Kerala', $response->json('data.0.state'));
    $this->assertSame('kerala', $response->json('data.0.slug'));
    $this->assertSame('Kerala MD/MS Counselling Guide', $response->json('data.0.banner_title'));
    $this->assertSame('A. Introductions, Duration, Fees', $response->json('data.0.preview_title'));
    $this->assertSame(
        ['Who is eligible to apply for Kerala MD/MS State Quota counselling through NEET PG 2025?'],
        $response->json('data.0.preview_points')
    );
    $this->assertArrayNotHasKey('sections', $response->json('data.0'));
    $this->assertArrayNotHasKey('action', $response->json('data.0'));
});
