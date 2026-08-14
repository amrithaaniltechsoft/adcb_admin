<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'slug' => 'united-kingdom',
                'title' => 'United Kingdom',
                'image' => '/pathway/united-kingdom.jpg',
                'flag' => '/c-flag/uk.png',
                'description' => "PLAB / UKMLA pathway for medical licensing\nDirect residency training opportunities with NHS salaries\nORE / LDS exam pathways for dentists registration\nHighly respected global qualifications with long-term residency options",
            ],
            [
                'slug' => 'united-arab-emirates',
                'title' => 'United Arab Emirates',
                'image' => '/pathway/united-arab-emirates.jpg',
                'flag' => '/c-flag/uae.png',
                'description' => "DHA (Dubai), DOH (Abu Dhabi), or MOH licensing options\nFastest growing medical and dental hub in the Middle East\nAttractive tax-free clinical compensation packages\nStraightforward licensing integration for Indian graduates",
            ],
            [
                'slug' => 'saudi-arabia',
                'title' => 'Saudi Arabia',
                'image' => '/pathway/saudi-arabia.jpg',
                'flag' => '/c-flag/sa.png',
                'description' => "High demand for general practitioners, specialists, and dental practitioners\nExcellent, rapidly growing medical infrastructure\nHighly competitive tax-free salaries and relocation benefits\nEasier licensing and transition pathways for overseas medical professionals",
            ],
            [
                'slug' => 'canada',
                'title' => 'Canada',
                'image' => '/pathway/canada.jpg',
                'flag' => '/c-flag/ca.png',
                'description' => "MCCEE / MCCQE licensing process for medical graduates\nNDEB equivalency and licensing process for dentists\nHigh quality of life, public safety, and premier earning brackets\nStrong pathways for permanent residency and citizenship",
            ],
            [
                'slug' => 'qatar',
                'title' => 'Qatar',
                'image' => '/pathway/qatar.jpg',
                'flag' => '/c-flag/qatar.png',
                'description' => "DHP (Department of Healthcare Professions) licensing\nHigh-income state-of-the-art healthcare market\nLucrative tax-free specialist packages and housing allowances\nRelatively short credential evaluation timeline",
            ],
            [
                'slug' => 'oman',
                'title' => 'Oman',
                'image' => '/pathway/oman.jpg',
                'flag' => '/c-flag/oman.png',
                'description' => "OMSB (Oman Medical Specialty Board) examinations\nExpanding healthcare system with clean clinics and hospitals\nAttractive specialist and general practitioner compensation\nStable environment, scenic lifestyle, and geographic proximity to India",
            ],
            [
                'slug' => 'australia-new-zealand',
                'title' => 'Australia & New Zealand',
                'image' => '/pathway/australia.jpg',
                'flag' => '/c-flag/au.webp',
                'description' => "AMC registration for physicians and ADC registration for dentists\nExceptional quality of life, work-life balance, and premier earnings\nStrong demand for rural and metropolitan clinical specialists\nWell-defined permanent residency pathways for skilled medical workers",
            ],
        ];

        $slugs = array_column($countries, 'slug');

        Opportunity::query()->whereNotIn('slug', $slugs)->delete();

        foreach ($countries as $index => $country) {
            Opportunity::updateOrCreate(
                ['slug' => $country['slug']],
                [
                    ...$country,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
