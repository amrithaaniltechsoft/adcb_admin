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
                'slug' => 'usa',
                'title' => 'USA',
                'image' => '/pathway/usa.jpg',
                'flag' => '/c-flag/usa.png',
                'description' => "Opportunity to pursue fellowships, advanced clinical training, research and medical practice\nIndian postgraduate doctors can enter the US pathway through ECFMG certification and USMLE requirements, subject to eligibility\nOpportunities across specialties in hospitals, academic medicine and research",
            ],
            [
                'slug' => 'united-kingdom',
                'title' => 'United Kingdom',
                'image' => '/pathway/united-kingdom.jpg',
                'flag' => '/c-flag/uk.png',
                'description' => "Indian MD/MS holders can explore specialist registration, NHS opportunities, fellowships and further training\nDoctors with acceptable international postgraduate qualifications can apply through the GMC's relevant registration routes\nParticularly attractive for doctors seeking NHS and academic career opportunities",
            ],
            [
                'slug' => 'australia',
                'title' => 'Australia',
                'image' => '/pathway/australia.jpg',
                'flag' => '/c-flag/au.webp',
                'description' => "Internationally trained specialists can apply through Australia's Specialist Pathway\nQualifications and specialist training are assessed by the relevant Australian authority before registration\nOpportunities include specialist practice, further training, research and hospital-based careers",
            ],
            [
                'slug' => 'new-zealand',
                'title' => 'New Zealand',
                'image' => '/pathway/australia.jpg',
                'flag' => '/c-flag/au.webp',
                'description' => "Overseas-trained specialists can apply for specialist/vocational registration through the appropriate pathway\nNew Zealand specifically has a pathway for specialists trained outside New Zealand and Australia, where qualifications and experience are assessed individually\nOpportunities are available in hospitals, specialist practice and healthcare services",
            ],
            [
                'slug' => 'united-arab-emirates',
                'title' => 'United Arab Emirates',
                'image' => '/pathway/united-arab-emirates.jpg',
                'flag' => '/c-flag/uae.png',
                'description' => "MD/MS doctors can explore opportunities in Dubai, Abu Dhabi and other Emirates\nSpecialist licensing is governed by UAE health authorities and is based on qualifications, training, experience and licensing requirements\nStrong opportunities in private hospitals, healthcare groups and specialist clinics",
            ],
            [
                'slug' => 'qatar',
                'title' => 'Qatar',
                'image' => '/pathway/qatar.jpg',
                'flag' => '/c-flag/qatar.png',
                'description' => "Indian postgraduate doctors can explore specialist medical practice and hospital opportunities\nQatar's DHP evaluates postgraduate qualifications and post-qualification clinical experience for specialist licensing\nOpportunities exist across government and private healthcare institutions",
            ],
            [
                'slug' => 'saudi-arabia',
                'title' => 'Saudi Arabia',
                'image' => '/pathway/saudi-arabia.jpg',
                'flag' => '/c-flag/sa.png',
                'description' => "Indian MD/MS doctors can explore opportunities for specialist medical practice in Saudi Arabia\nOverseas postgraduate qualifications are assessed by the Saudi Commission for Health Specialties (SCFHS) for professional classification\nOpportunities are available across government hospitals, private hospitals, healthcare groups and specialist clinics\nDoctors may pursue careers in specialist departments corresponding to their postgraduate qualification\nInternational qualifications require appropriate verification, professional registration and clinical experience as applicable under SCFHS requirements",
            ],
            [
                'slug' => 'ireland',
                'title' => 'Ireland',
                'image' => '/pathway/united-kingdom.jpg',
                'flag' => '/c-flag/uk.png',
                'description' => "Indian MD/MS doctors can explore opportunities for medical practice, specialist pathways and further postgraduate training in Ireland\nInternationally trained doctors can pursue registration through the Medical Council of Ireland, subject to the applicable registration pathway\nOpportunities exist across public hospitals, private healthcare, specialist services, research and academic medicine\nDoctors may also explore further specialist training and fellowship opportunities\nRegistration and specialist practice are subject to qualification assessment, registration requirements and applicable Irish medical regulations",
            ],
            [
                'slug' => 'germany',
                'title' => 'Germany',
                'image' => '/pathway/united-kingdom.jpg',
                'flag' => '/c-flag/uk.png',
                'description' => "Indian MD/MS doctors can explore opportunities for specialist medical practice and further medical training in Germany\nDoctors with overseas specialist qualifications can apply for recognition of their specialist title in Germany\nMedical practice requires the appropriate German medical licence (Approbation) before specialist-title recognition can be pursued\nOpportunities are available in hospitals, specialist departments, clinics, research and academic healthcare\nThe pathway generally involves recognition of qualifications, licensing and German-language requirements",
            ],
            [
                'slug' => 'canada',
                'title' => 'Canada',
                'image' => '/pathway/canada.jpg',
                'flag' => '/c-flag/ca.png',
                'description' => "Indian MD/MS doctors can explore pathways for specialist practice, further training, fellowship and advanced medical careers in Canada\nInternationally trained specialists may be assessed through routes such as the Royal College Practice Eligibility Route (PER), depending on their specialty and training background\nThe assessment compares international postgraduate training with Canadian specialist-training standards\nEligible doctors may need to complete Royal College examinations and practice requirements before certification\nMedical licensing is ultimately handled by the provincial or territorial medical regulatory authority, separate from Royal College certification",
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
