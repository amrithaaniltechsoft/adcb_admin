<?php

namespace Database\Seeders;

use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class SeoMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'home',
                'meta_title' => 'ADCB Consultancy | Premium Educational Admission & Career Counselling',
                'meta_description' => 'ADCB Consultancy provides elite educational admission assistance and career counselling for MBBS, MD/MS, MDS, MBA, and MTTM programs. Expert guidance for international pathways including UAE, UK, Australia, and Canada.',
                'meta_keywords' => 'ADCB, education consultancy, MBBS admission, MDS, MD MS, MBA, MTTM, dental speciality, study abroad, career counselling, UAE dental license',
            ],
            [
                'page_name' => 'about',
                'meta_title' => 'About Us | ADCB Consultancy',
                'meta_description' => 'Learn about ADCB Consultancy, a trusted educational admission and career counselling partner for medical and management programs.',
                'meta_keywords' => 'ADCB about, education consultancy about, career counselling company',
            ],
            [
                'page_name' => 'contact',
                'meta_title' => 'Contact Us | ADCB Consultancy',
                'meta_description' => 'Reach ADCB Consultancy for medical admission counselling. Visit our Kochi or Calicut office or contact us by phone and email.',
                'meta_keywords' => 'ADCB contact, medical counselling Kochi, counselling Calicut, admission help',
            ],
            [
                'page_name' => 'blog',
                'meta_title' => 'Blog | ADCB Consultancy',
                'meta_description' => 'Read expert articles on medical admissions, counselling, and career guidance from ADCB Consultancy.',
                'meta_keywords' => 'medical admission blog, counselling tips, career guidance articles',
            ],
            [
                'page_name' => 'mbbs',
                'meta_title' => 'MBBS Admissions | ADCB Consultancy',
                'meta_description' => 'MBBS admission guidance for government and private medical colleges across India with expert counselling support.',
                'meta_keywords' => 'MBBS admission, MBBS counselling, NEET counselling, medical admission India',
            ],
            [
                'page_name' => 'md-ms',
                'meta_title' => 'MD/MS Admissions | ADCB Consultancy',
                'meta_description' => 'MD/MS postgraduate medical admission guidance with state-wise counselling support for all major states.',
                'meta_keywords' => 'MD MS admission, postgraduate medical counselling, PG medical admission India',
            ],
            [
                'page_name' => 'mds',
                'meta_title' => 'MDS Admissions | ADCB Consultancy',
                'meta_description' => 'MDS postgraduate dental admission guidance and counselling support across India.',
                'meta_keywords' => 'MDS admission, dental postgraduate counselling, MDS counselling India',
            ],
            [
                'page_name' => 'dnb',
                'meta_title' => 'DNB Specialities | ADCB Consultancy',
                'meta_description' => 'Explore all DNB specialities with ADCB Consultancy and get expert admission counselling for diploma in national board courses.',
                'meta_keywords' => 'DNB admission, DNB specialities, DNB counselling, postgraduate medical',
            ],
            [
                'page_name' => 'international-opportunities',
                'meta_title' => 'International Opportunities | ADCB Consultancy',
                'meta_description' => 'Explore international medical study and career opportunities with expert guidance for UAE, UK, Australia, and Canada.',
                'meta_keywords' => 'study abroad, international medical admissions, UAE dental license, UK medical',
            ],
        ];

        foreach ($pages as $page) {
            SeoMeta::updateOrCreate(['page_name' => $page['page_name']], $page);
        }
    }
}
