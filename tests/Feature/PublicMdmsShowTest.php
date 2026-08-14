<?php

use App\Models\MdmsContent;

test('public mdms show endpoint returns banner and meta fields', function () {
    MdmsContent::create([
        'state_slug' => 'kerala',
        'banner_title' => 'Kerala MD/MS Counselling Guide',
        'banner_description' => 'Complete information on eligibility, CAP counselling, reservation, fee structure, and expert guidance for Kerala MD/MS admissions.',
        'meta_title' => 'MD/MS in Kerala | PG Medical Admissions | ADCB Consultancy',
        'meta_description' => 'Complete guide to Kerala MD/MS admissions — CAP counselling, eligibility, reservation, fees, and expert NEET PG guidance.',
        'meta_keywords' => 'Kerala MD/MS counselling, NEET PG Kerala',
        'title' => 'Kerala MD/MS',
        'subtitle' => 'Complete Counselling Guide',
        'intro' => 'Everything you need to know about Kerala MD/MS counselling.',
        'sections' => [
            [
                'id' => 'A',
                'label' => 'A. Introductions, Duration, Fees',
                'questions' => ['Who is eligible to apply for Kerala MD/MS State Quota counselling through NEET PG 2025?'],
            ],
        ],
    ]);

    $response = $this->getJson('/api/v1/mdms/kerala')->assertOk();

    $this->assertSame('kerala', $response->json('data.state_slug'));
    $this->assertSame('Kerala MD/MS Counselling Guide', $response->json('data.banner_title'));
    $this->assertSame('MD/MS in Kerala | PG Medical Admissions | ADCB Consultancy', $response->json('data.meta_title'));
    $this->assertSame('Complete guide to Kerala MD/MS admissions — CAP counselling, eligibility, reservation, fees, and expert NEET PG guidance.', $response->json('data.meta_description'));
    $this->assertSame('Kerala MD/MS counselling, NEET PG Kerala', $response->json('data.meta_keywords'));
    $this->assertCount(1, $response->json('data.sections'));
});
