<?php

namespace Database\Seeders;

use App\Models\DnbContent;
use Illuminate\Database\Seeder;

class DnbContentSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = implode("\n", [
            'ANAESTHESIOLOGY',
            'ANATOMY',
            'BIOCHEMISTRY',
            'COMMUNITY MEDICINE',
            'CARDIO VASCULAR & THORACIC SURGERY (DIRECT 6 YEARS COURSE)',
            'DERMATOLOGY AND VENEREOLOGY AND LEPROSY',
            'EMERGENCY MEDICINE',
            'FAMILY MEDICINE',
            'FORENSIC MEDICINE',
            'GENERAL MEDICINE',
            'GENERAL SURGERY',
            'HOSPITAL ADMINISTRATION',
            'IMMUNO-HAEMATOLOGY AND BLOOD TRANSFUSION',
            'MICROBIOLOGY',
            'NUCLEAR MEDICINE',
            'NEURO SURGERY (DIRECT 6 YEARS COURSE)',
            'OPHTHALMOLOGY',
            'ORTHOPAEDICS',
            'OBSTETRICS AND GYNAECOLOGY',
            'OTORHINOLARYNGOLOGY (E.N.T.)',
            'PAEDIATRICS',
            'PATHOLOGY',
            'PHARMACOLOGY',
            'PHYSICAL MED. AND REHABILITATION',
            'PHYSIOLOGY',
            'PSYCHIATRY',
            'PAEDIATRIC SURGERY (DIRECT 6 YEARS COURSE)',
            'PALLIATIVE MEDICINE',
            'PLASTIC & RECONSTRUCTIVE SURGERY (DIRECT 6 YEARS COURSE)',
            'RADIATION ONCOLOGY',
            'RADIO-DIAGNOSIS',
            'RESPIRATORY MEDICINE',
            'TUBERCULOSIS AND CHEST DISEASES',
        ]);

        DnbContent::updateOrCreate(['id' => 1], [
            'banner_title' => 'DNB Specialties',
            'banner_description' => 'Explore the complete list of DNB (Diplomate of National Board) specialties for PG medical admissions across India.',
            'intro_title' => 'Available Specialties',
            'intro_description' => 'DNB courses are offered by the National Board of Examinations (NBE) in medical institutions and hospitals recognised for PG training across the country.',
            'specialties' => $specialties,
            'meta_title' => 'DNB Specialties | PG Medical Admissions | ADCB Consultancy',
            'meta_description' => 'Complete guide to DNB (Diplomate of National Board) specialties — the full list of broad and super-specialty courses, eligibility, and expert counselling guidance.',
            'meta_keywords' => 'DNB admission, DNB specialities, DNB counselling, postgraduate medical',
        ]);
    }
}
