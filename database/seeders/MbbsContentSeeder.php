<?php

namespace Database\Seeders;

use App\Http\Controllers\MbbsController;
use App\Models\MbbsContent;
use Illuminate\Database\Seeder;

class MbbsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MbbsContent::query()->whereNotIn('slug', array_keys(MbbsController::STATES))->delete();

        $banners = [
            'tamil-nadu' => [
                'banner_title' => 'MBBS Admissions in Tamil Nadu',
                'banner_description' => 'Secure your medical seat in premier medical colleges across Tamil Nadu. Expert guidance for NEET UG counselling and admissions.',
            ],
            'kerala' => [
                'banner_title' => 'Kerala MBBS Counselling Guide',
                'banner_description' => 'Complete information on eligibility criteria, CAP counselling, reservation, fee structure, and expert guidance for Kerala MBBS admissions.',
            ],
            'karnataka' => [
                'banner_title' => 'Karnataka MBBS Counselling Guide',
                'banner_description' => 'Complete information on instructions, fee structure, and document requirements for Karnataka MBBS admissions.',
            ],
            'pondicherry' => [
                'banner_title' => 'Pondicherry MBBS Counselling Guide',
                'banner_description' => 'Complete information on CENTAC counselling, seat categories, eligibility, fee structure, and expert guidance for Pondicherry MBBS admissions.',
            ],
            'telangana' => [
                'banner_title' => 'Telangana MBBS Counselling Guide',
                'banner_description' => 'Complete information on eligibility, seat quota, reservation, application process, and fee structure for Telangana MBBS admissions.',
            ],
            'andhra-pradesh' => [
                'banner_title' => 'Andhra Pradesh MBBS Counselling Guide',
                'banner_description' => 'Complete information on regulations, seat categories, eligibility criteria, and fee structure for Andhra Pradesh MBBS admissions.',
            ],
            'haryana' => [
                'banner_title' => 'Haryana MBBS Counselling Guide',
                'banner_description' => 'Complete information on reservations, eligibility criteria, admission process, NRI quota, and fee structure for Haryana MBBS admissions.',
            ],
            'punjab' => [
                'banner_title' => 'Punjab MBBS Counselling Guide',
                'banner_description' => 'Complete information on general instructions, NRI admissions, and eligibility criteria for Punjab MBBS counselling.',
            ],
            'himachal-pradesh' => [
                'banner_title' => 'Himachal Pradesh MBBS Counselling Guide',
                'banner_description' => 'Complete information on seat distribution, eligibility criteria, NRI category, and counselling procedure for Himachal Pradesh MBBS admissions.',
            ],
            'uttar-pradesh' => [
                'banner_title' => 'Uttar Pradesh MBBS Counselling Guide',
                'banner_description' => 'Complete information on eligibility, quota selection, counselling rounds, and strategic guidance for Uttar Pradesh MBBS admissions.',
            ],
            'bihar' => [
                'banner_title' => 'Bihar MBBS Counselling Guide',
                'banner_description' => 'Complete information on eligibility, seat categories, counselling rounds, security deposit, and choice filling strategy for Bihar MBBS admissions.',
            ],
        ];

        $previews = [
            'tamil-nadu' => [
                'preview_title' => 'Disclaimer Points',
                'preview_points' => "One mistake in document submission can lead to cancellation of admission, forfeiture of fees, and debarment from future counselling\nCertain rounds of counselling have strict joining rules. Failure to join after allotment may result in loss of Security Deposit and Tuition Fees\nNot all candidates are eligible for Minority, Institutional, NRI, or special category seats. Eligibility needs to be verified before counselling\nSecurity Deposit refunds are subject to counselling regulations. Many families are unaware of situations where refunds may be delayed or forfeited\nFee structures, bond conditions, and college-specific rules may differ across institutions. Candidates should understand these before choice filling",
            ],
            'kerala' => [
                'preview_title' => 'Introduction',
                'preview_points' => "Is your NEET rank alone enough to secure an MBBS seat in Kerala?\nDo you know how Kerala's CAP counselling actually works?\nAre you aware of the hidden eligibility and counselling rules beyond your NEET rank?",
            ],
            'karnataka' => [
                'preview_title' => 'Instructions for First MBBS Admission (Academic Year 2025-26)',
                'preview_points' => "Additional documents may be required depending on your category\nMandatory affidavits and bonds before admission\nDocument verification is more than just carrying originals",
            ],
            'pondicherry' => [
                'preview_title' => 'Introduction',
                'preview_points' => "Can students from other states also get MBBS admission in Puducherry, or is it only for Puducherry domicile candidates?\nWhat is the difference between Government Quota, Management Quota, Self-Supporting Quota, Minority Quota, and NRI Quota in Puducherry MBBS admissions?\nCan I participate in both CENTAC counselling and MCC counselling for MBBS, and which option gives me a better chance of getting a seat?",
            ],
            'telangana' => [
                'preview_title' => 'Number of Seats under Competent Authority Quota',
                'preview_points' => "Can you get an MBBS seat if new seats are approved after the counselling process has already started?\nWhen will the final Telangana MBBS seat matrix be released, and how can it change your college options?\nAre all Government and Private MBBS seats available from the beginning, or are additional seats added later without a fresh notification?",
            ],
            'andhra-pradesh' => [
                'preview_title' => 'Regulations',
                'preview_points' => "Can a single application make you eligible for every MBBS seat category in Andhra Pradesh, or are separate counselling rules involved?\nWhat is the difference between Competent Authority, Management Quota (Category-B), and NRI (Category-C) seats - and which one are you actually eligible for?\nWhy does Andhra Pradesh conduct separate counselling for different seat categories even though the application process is common?",
            ],
            'haryana' => [
                'preview_title' => 'Reservations',
                'preview_points' => "Are all MBBS seats in Haryana reserved under the State Quota, or how are seats divided between All India Quota, State Quota, Management Quota, and NRI Quota?\nCan every NEET-qualified candidate claim Haryana State Quota benefits, or are there specific eligibility conditions for reservation?\nAre reservations and seat distribution the same in Government, Private, and Private University medical colleges in Haryana?",
            ],
            'punjab' => [
                'preview_title' => 'General Instructions',
                'preview_points' => "Are you really eligible for Punjab MBBS State Counselling?\nCan your allotted MBBS seat be cancelled even after allotment?\nDid you know your preferred college may not appear in the final seat matrix?\nWill paying the admission fee confirm your MBBS seat?\nAre you filling the correct college and quota preferences during counselling?\nWhat happens if Punjab MBBS counselling rules change after you apply?",
            ],
            'himachal-pradesh' => [
                'preview_title' => 'Introduction',
                'preview_points' => "Are you eligible for Himachal Pradesh MBBS State Quota, or can you apply only under the Management Quota?\nCan non-Himachali candidates get admission to MBBS in Himachal Pradesh? If yes, under which quota and what are the eligibility conditions?\nWhat documents are mandatory after seat allotment, and can your admission be cancelled if even one document is missing at the time of reporting?",
            ],
            'uttar-pradesh' => [
                'preview_title' => 'Key Questions',
                'preview_points' => "Can students from other states apply for MBBS admission in Uttar Pradesh? If yes, which quota are they eligible for?\nWhich quota should you choose in Uttar Pradesh counselling to maximize your chances of getting an MBBS seat?\nCan a wrong choice filling strategy cost you a better medical college even with a good NEET rank?\nIf you don't get a seat in Round 1, should you still participate in Round 2 and Mop-Up Round?\nCan you upgrade your allotted college without losing your existing seat during counselling?",
            ],
            'bihar' => [
                'preview_title' => 'Key Questions',
                'preview_points' => "Did you know that 50% of the seats in Bihar Private Medical Colleges are offered at Government Medical College fees? Are you eligible for them?\nAre you sure you know which candidates can participate in Bihar MBBS Counselling? Is Bihar domicile mandatory for every type of seat?\nPlanning to apply for Private Medical Colleges? Do you know why you may have to deposit ₹2,00,000 as a refundable security deposit?\nDo you know what happens to your security deposit if you don't join the allotted college or skip the reporting process?\nRound 1, Round 2, Round 3 & Stray Vacancy Round - Do you know which rounds you remain eligible for after getting a seat?",
            ],
        ];

        foreach (MbbsController::STATES as $slug => $state) {
            $payload = [
                'state' => $state,
                ...$banners[$slug],
                ...$previews[$slug],
                'banner_image' => '/courses/mbbs.jpg',
            ];

            if ($slug === 'karnataka') {
                $payload['content'] = '<h2>A. Instructions for Students Seeking Admission to First MBBS (Academic Year 2025-26)</h2>'
                    .'<ul>'
                    .'<li><strong>Additional Documents May Be Required Depending on Your Category</strong></li>'
                    .'<li><strong>Mandatory Affidavits &amp; Bonds Before Admission</strong></li>'
                    .'<li><strong>Document Verification Is More Than Just Carrying Originals</strong></li>'
                    .'</ul>'
                    .'<blockquote>Avoid last-minute surprises — get your documents verified by ADCB before reporting.</blockquote>'
                    .'<h2>B. Fee Structure</h2>'
                    .'<ul>'
                    .'<li><strong>How Much MBBS Fee Do You Actually Have to Pay in Karnataka?</strong></li>'
                    .'<li><strong>Are You Eligible for Fee Concessions or SSP Scholarship Benefits?</strong></li>'
                    .'<li><strong>Do You Know the Correct Fee Payment Process for Your Allotted Seat?</strong></li>'
                    .'</ul>';
                $payload['meta_title'] = 'MBBS in Karnataka | Admissions & Counselling | ADCB Consultancy';
                $payload['meta_description'] = 'Complete guide to Karnataka MBBS counselling — instructions, fee structure, document requirements, and expert guidance.';
                $payload['meta_keywords'] = 'Karnataka MBBS admission, MBBS counselling Karnataka, NEET UG Karnataka, medical admission Karnataka';
            }

            if ($slug === 'tamil-nadu') {
                $payload['content'] = $this->tamilNaduContent();
                $payload['meta_title'] = 'MBBS in Tamil Nadu | Admissions & Counselling | ADCB Consultancy';
                $payload['meta_description'] = 'Secure MBBS admission in top medical colleges across Tamil Nadu. Expert NEET UG counselling for government and private medical seats.';
                $payload['meta_keywords'] = 'Tamil Nadu MBBS admission, MBBS counselling Tamil Nadu, NEET UG Tamil Nadu, medical admission Tamil Nadu';
            }

            if ($slug === 'kerala') {
                $payload['content'] = $this->keralaContent();
                $payload['meta_title'] = 'MBBS in Kerala | Admissions & Counselling | ADCB Consultancy';
                $payload['meta_description'] = 'Complete guide to Kerala MBBS counselling — eligibility, CAP process, reservation, fees, and expert guidance for NEET admissions.';
                $payload['meta_keywords'] = 'Kerala MBBS admission, MBBS counselling Kerala, NEET UG Kerala, CAP counselling Kerala';
            }

            MbbsContent::updateOrCreate(['slug' => $slug], $payload);
        }
    }

    /**
     * Build the complete Kerala MBBS counselling guide as HTML.
     */
    private function keralaContent(): string
    {
        $sections = [
            [
                'heading' => 'A. Introduction',
                'blocks' => [
                    ['faq', 'Is your NEET rank alone enough to secure an MBBS seat in Kerala?'],
                    ['faq', 'Do you know how Kerala\'s CAP counselling actually works?'],
                    ['faq', 'Are you aware of the hidden eligibility and counselling rules beyond your NEET rank?'],
                ],
            ],
            [
                'heading' => 'B. Courses, Institutions and Seats',
                'blocks' => [
                    ['faq', 'Do you know which seat category gives you the best chance of getting an MBBS seat in Kerala? (Government, State Quota, Management, NRI, Minority or All India Quota?)'],
                    ['faq', 'Can you participate in Kerala MBBS counselling for Government, Private, Management & NRI seats through a single counselling process?'],
                    ['faq', 'Do you know when the final MBBS seat matrix and participating colleges are announced—and how it can impact your admission chances?'],
                ],
            ],
            [
                'heading' => 'C. Duration of the Courses',
                'blocks' => [
                    ['faq', 'Is Kerala MBBS actually a 4½-year course—or does it take 5½ years to complete?'],
                    ['faq', 'Is the 1-year compulsory internship mandatory to obtain your MBBS degree and medical registration?'],
                    ['faq', 'Do you know when you\'ll become eligible for PG entrance exams and start your medical career after MBBS?'],
                ],
            ],
            [
                'heading' => 'D. Reservation of Seats for Various Courses',
                'blocks' => [
                    ['faq', 'Are you applying under the right quota—or could you be missing a better MBBS admission opportunity? (State Merit, EWS, SEBC, SC/ST, Management, NRI, Minority or All India Quota)'],
                    ['faq', 'Can a mistake in claiming your reservation category cost you an MBBS seat in Kerala?'],
                ],
            ],
            [
                'heading' => 'E. Claims for Reservation and Certificates to be Uploaded',
                'blocks' => [
                    ['alert', 'Reservation & Certificate Confusion?'],
                    ['faq', 'Are you eligible for more than one reservation category, and which one gives you the best chance of securing an MBBS seat in Kerala?'],
                    ['faq', 'Do you know exactly which certificates and supporting documents are mandatory for your reservation claim?'],
                    ['faq', 'What happens if you select the wrong reservation category or fail to upload the required certificates before the application deadline?'],
                    ['cta', 'Confused about your reservation eligibility or required certificates? Let ADCB verify everything before you apply.'],
                ],
            ],
            [
                'heading' => 'F. Criteria of Eligibility for Admission',
                'blocks' => [
                    ['alert', 'Eligibility Confusions – Are You Sure You\'re Eligible?'],
                    ['faq', 'Are you eligible for Kerala MBBS as a Keralite, Non-Keralite Category I (NK-I), or Non-Keralite Category II (NK-II)?'],
                    ['faq', 'Do you know which nativity certificate or supporting documents you need to prove your eligibility for Kerala MBBS admission?'],
                    ['faq', 'Will your NEET score, Class 12 marks, category, age, and domicile make you eligible for the seat you\'re aiming for?'],
                    ['cta', 'Confused about your eligibility or the certificates required for Kerala MBBS admission? Let ADCB verify your eligibility, check your documents, and guide you to the right admission pathway before you apply.'],
                ],
            ],
            [
                'heading' => 'G. How to Apply for the Entrance Examination / Admission',
                'blocks' => [
                    ['faq', 'Have you uploaded all the mandatory documents correctly?'],
                    ['faq', 'Did you know you cannot edit your application after final submission?'],
                    ['faq', 'Can you upload missing certificates after submitting the application?'],
                    ['cta', 'Confused about the application process, mandatory documents, or whether your application is complete? Let ADCB verify your eligibility and documents before you apply—so you don\'t lose your MBBS seat due to avoidable mistakes.'],
                ],
            ],
            [
                'heading' => 'H. Examinations',
                'blocks' => [
                    ['faq', 'I qualified NEET. Am I actually eligible for Kerala MBBS Counselling?'],
                    ['faq', 'How is the Kerala MBBS Rank List prepared, and where will I stand?'],
                    ['faq', 'What mistakes can cancel my admission even after qualifying NEET?'],
                ],
            ],
            [
                'heading' => 'I. Centralised Allotment Process (CAP) & Online Submission of Options',
                'blocks' => [
                    ['alert', '🤔 Are you sure you understand Kerala MBBS CAP completely?'],
                    ['faq', 'What happens if you arrange your options incorrectly, miss the mandatory option confirmation after an allotment, or decide not to join the allotted MBBS seat?'],
                    ['cta', "A single mistake during the Kerala Centralised Allotment Process (CAP) can affect your future allotments, upgrade chances, or even lead to the loss of your existing seat and remaining options. Before you lock your choices, make sure you understand every rule and its consequences.\n\n📞 Connect with ADCB's Kerala MBBS Counselling Experts for a personalized CAP strategy and avoid costly counselling mistakes."],
                ],
            ],
            [
                'heading' => 'J. Fees',
                'blocks' => [
                    ['faq', 'Can one wrong counselling decision cost you ₹10 Lakhs?'],
                    ['faq', 'Are you really eligible for fee concessions in Kerala MBBS?'],
                    ['faq', 'Will you get your counselling fee back if you cancel your MBBS admission?'],
                    ['cta', '📞 Connect with ADCB\'s Kerala MBBS Counselling Experts to understand the fee structure, refund policy, concessions, and penalty rules before participating in counselling.'],
                ],
            ],
            [
                'heading' => 'K. Courses & Institutions',
                'blocks' => [
                    ['faq', 'Are MBBS students in Kerala required to complete Rural Service after graduation? What are the actual rules and who has to serve?'],
                    ['faq', 'Apart from NEET and document verification, are there any compulsory medical requirements before MBBS admission?'],
                    ['faq', 'What happens if you fail to report to the allotted college on the scheduled date? Can your MBBS seat be restored?'],
                    ['cta', 'Connect with ADCB\'s Kerala MBBS experts to understand every hidden rule before counselling, so you make informed decisions and avoid costly mistakes.'],
                ],
            ],
        ];

        $html = '';
        foreach ($sections as $section) {
            $html .= '<h2>'.$section['heading'].'</h2>';
            $html .= $this->renderBlocks($section['blocks']);
        }

        return $html;
    }

    /**
     * Build the complete Tamil Nadu MBBS counselling guide as HTML.
     */
    private function tamilNaduContent(): string
    {
        $sections = [
            [
                'heading' => 'A. Disclaimer Points',
                'blocks' => [
                    ['warn', 'One mistake in document submission can lead to cancellation of admission, forfeiture of fees, and debarment from future counselling.'],
                    ['warn', 'Certain rounds of counselling have strict joining rules. Failure to join after allotment may result in loss of Security Deposit and Tuition Fees.'],
                    ['warn', 'Not all candidates are eligible for Minority, Institutional, NRI, or special category seats. Eligibility needs to be verified before counselling.'],
                    ['warn', 'Security Deposit refunds are subject to counselling regulations. Many families are unaware of situations where refunds may be delayed or forfeited.'],
                    ['warn', 'Fee structures, bond conditions, and college-specific rules may differ across institutions. Candidates should understand these before choice filling.'],
                    ['cta', '📞 Confused about any of these rules?', 'Connect with ADCB\'s MBBS Counselling Experts for personalized Tamil Nadu counselling guidance and admission strategy.'],
                ],
            ],
            [
                'heading' => 'B. Glossary of Terms',
                'blocks' => [
                    ['faq', 'Can NRI seats become available for Management Quota candidates later during counselling?'],
                    ['faq', 'What is an \'NRI Lapsed Seat\' and why do many students miss this opportunity?'],
                    ['faq', 'What happens if you don\'t join after receiving a seat allotment?'],
                    ['faq', 'Can you resign from an allotted seat without financial penalties?'],
                    ['faq', 'What is \'Free Exit\' and which counselling rounds allow it?'],
                    ['faq', 'Can a student lose both Tuition Fee and Security Deposit due to a counselling mistake?'],
                    ['faq', 'What is a \'Virtual Vacancy\' and how can it create unexpected MBBS opportunities in Round 2?'],
                    ['faq', 'Are Government Quota and Management Quota applications separate in Tamil Nadu?'],
                    ['faq', 'What additional charges are payable apart from the annual tuition fee?'],
                    ['cta', '⚠️ One misunderstanding of these counselling rules can result in loss of a seat, forfeiture of fees, or missing a better college opportunity.', '📞 Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before filling your choices.'],
                ],
            ],
            [
                'heading' => 'C. Important Information',
                'blocks' => [
                    ['faq', 'Can a candidate lose the entire ₹1,00,000 Security Deposit even after getting a seat?'],
                    ['faq', 'Why do some students lose both their Tuition Fee and Security Deposit after allotment?'],
                    ['faq', 'Can a better counselling strategy help secure a lower-fee MBBS seat?'],
                    ['faq', 'How are CMC Vellore MBBS seats distributed among different categories?'],
                    ['faq', 'Can non-Christian candidates get admission to CMC Vellore?'],
                    ['faq', 'Why do some students with good NEET scores still miss admission opportunities?'],
                ],
            ],
            [
                'heading' => 'D. General Instructions',
                'blocks' => [
                    ['faq', 'Can vacant Minority seats become available to other candidates in later rounds?'],
                    ['faq', 'What happens to unfilled NRI seats during counselling?'],
                    ['faq', 'Can a candidate miss an MBBS seat simply because they didn\'t understand seat conversion rules?'],
                    ['faq', 'Why do some students get admission despite having lower ranks than others?'],
                    ['faq', 'Are some MBBS opportunities available only after category conversion?'],
                    ['faq', 'Can understanding seat conversion rules increase your college options?'],
                ],
            ],
            [
                'heading' => 'E. Age Limit',
                'blocks' => [
                    ['panel', 'MBBS Eligibility Check', 'Are You Eligible for Tamil Nadu MBBS Counselling?'],
                ],
            ],
            [
                'heading' => 'F. General Eligibility Criteria',
                'blocks' => [
                    ['faq', 'Can OCI/PIO candidates apply for Tamil Nadu MBBS? If yes, are they eligible for reservation benefits?'],
                    ['faq', 'Is qualifying NEET enough for MBBS admission, or do your Class 12 marks and subject combination also determine your eligibility?'],
                    ['faq', 'Have you completed Class 12 from a Board outside Tamil Nadu? Do you need an Eligibility Certificate before participating in Tamil Nadu MBBS counselling?'],
                    ['cta', '📞 Speak with ADCB\'s MBBS Counselling Experts to verify your eligibility before applying.'],
                ],
            ],
            [
                'heading' => 'G. Eligibility for Minority Seats',
                'blocks' => [
                    ['alert', '🚨 Minority Quota – Are You Really Eligible?'],
                    ['faq', 'Can every Christian candidate apply for Christian Minority MBBS seats in Tamil Nadu, or are there additional eligibility requirements?'],
                    ['faq', 'Are Telugu and Malayalam-speaking candidates automatically eligible for Linguistic Minority seats, or are specific documents mandatory?'],
                    ['faq', 'Can you claim a Minority seat during counselling if you didn\'t submit the required Minority documents at the time of application?'],
                    ['cta', '📞 Unsure about your Minority Quota eligibility? Speak with ADCB\'s MBBS Counselling Experts before applying.'],
                ],
            ],
            [
                'heading' => 'H. Eligibility Criteria for NRI',
                'blocks' => [
                    ['alert', '🌍 NRI Quota – Are You Actually Eligible?'],
                    ['faq', 'Can any NRI relative sponsor your MBBS admission, or are only specific family members legally eligible?'],
                    ['faq', 'Are you sure you have all the mandatory NRI documents? Missing even one required document can result in rejection of your NRI application.'],
                    ['faq', 'Does holding an OCI card automatically make you eligible for NRI Quota and other reserved seats in Tamil Nadu MBBS counselling?'],
                    ['cta', '📞 Unsure about your NRI eligibility? Speak with ADCB\'s MBBS Counselling Experts before submitting your application.'],
                    ['alert', '🚫 Before You Apply – Are You Eligible?'],
                    ['faq', 'Have you completed Class 12 from a Board outside Tamil Nadu? Do you need an Eligibility Certificate before your application can be accepted?'],
                    ['faq', 'Can a student who is already pursuing MBBS in India or abroad apply again for MBBS through Tamil Nadu counselling?'],
                    ['faq', 'Can an application be rejected even after qualifying NEET because of an eligibility-related requirement?'],
                    ['cta', '📞 Not sure whether you\'re eligible? Speak with ADCB\'s MBBS Counselling Experts before submitting your application.'],
                ],
            ],
            [
                'heading' => 'J. Procedure for Filling and Submission of Online Application Form',
                'blocks' => [
                    ['alert', '📝 Before You Submit Your Tamil Nadu MBBS Application…'],
                    ['faq', 'Can a single mistake in your online application or uploaded documents lead to rejection of your MBBS application?'],
                    ['faq', 'Can you edit or correct your application after submitting it, or is it locked permanently?'],
                    ['faq', 'Are you sure you have uploaded every mandatory document required for your category (General / Minority / NRI / OCI)?'],
                    ['cta', '📞 Avoid costly application mistakes. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before submitting your application.'],
                ],
            ],
            [
                'heading' => 'K. Method of Fee Payment',
                'blocks' => [
                    ['alert', '💳 Before You Make Any Payment…'],
                    ['faq', 'Is money deducted from your bank account enough to confirm your Tamil Nadu MBBS application payment?'],
                    ['faq', 'Which bank account should you use if you want your Security Deposit refund without any issues?'],
                    ['faq', 'Can an incorrect bank account entered during registration delay or affect your Security Deposit refund?'],
                    ['cta', '📞 Not sure about the payment or refund process? Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before making your payment.'],
                ],
            ],
            [
                'heading' => 'L. Community Certificate',
                'blocks' => [
                    ['alert', '📜 Community Certificate – Is Yours Valid for Tamil Nadu MBBS Counselling?'],
                    ['faq', 'Is your Community Certificate issued by the correct authority, or could it be rejected during verification?'],
                    ['faq', 'Can an incorrect or invalid Community Certificate lead to cancellation of your MBBS admission even after joining the college?'],
                    ['faq', 'Are you sure your Community Certificate meets the latest Tamil Nadu MBBS counselling requirements?'],
                    ['cta', '📞 Not sure whether your Community Certificate is valid? Get it verified by ADCB\'s Tamil Nadu MBBS Counselling Experts before applying.'],
                ],
            ],
            [
                'heading' => 'M. Rank List and Method of Selection',
                'blocks' => [
                    ['alert', '🎯 MBBS Selection Process – Are You Missing Hidden Admission Opportunities?'],
                    ['faq', 'Does qualifying NEET guarantee an MBBS seat in Tamil Nadu, or are there additional selection criteria you must satisfy?'],
                    ['faq', 'What happens to vacant NRI MBBS seats in later counselling rounds? Can non-NRI candidates become eligible for these seats?'],
                    ['faq', 'If Minority MBBS seats remain vacant, who becomes eligible for those seats in the subsequent counselling rounds?'],
                    ['cta', '📞 Don\'t miss hidden admission opportunities. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts to understand the complete selection process.'],
                ],
            ],
            [
                'heading' => 'N. Rounds of Online Counselling',
                'blocks' => [
                    ['alert', '🎯 Tamil Nadu MBBS Counselling Rounds – One Wrong Decision Can Cost You a Seat!'],
                    ['faq', 'Should you accept a seat in Round 1, or wait for a better college in Round 2? Which strategy gives you the best chance of admission?'],
                    ['faq', 'What happens if you don\'t join the seat allotted in Round 3 or the Stray Round? Can you lose your Security Deposit, Tuition Fee, and become ineligible for future counselling?'],
                    ['faq', 'Is the Stray Round your last opportunity to secure an MBBS seat? Who is actually eligible to participate?'],
                    ['cta', '📞 Every counselling round follows different rules. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before making your next move.'],
                ],
            ],
            [
                'heading' => 'O. Counselling Procedures',
                'blocks' => [
                    ['alert', '📢 Tamil Nadu MBBS Counselling – Don\'t Make These Costly Mistakes!'],
                    ['faq', 'If you miss the First Round of Tamil Nadu MBBS counselling, can you still participate in the Second Round?'],
                    ['faq', 'Can you change your college preferences after locking your choices in the same counselling round?'],
                    ['faq', 'Once a seat is allotted, can you request a transfer to another college or MBBS course later?'],
                    ['cta', '📞 Every counselling decision can impact your admission. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before filling your choices.'],
                ],
            ],
            [
                'heading' => 'P. Categories of Seats',
                'blocks' => [
                    ['alert', '🎯 Which MBBS Seat Category Gives You the Best Admission Opportunity?'],
                    ['faq', 'What is the difference between Management Quota, Minority Quota, NRI Quota, and NRI Lapsed Seats? Which category are you actually eligible for?'],
                    ['faq', 'Can a non-NRI candidate get admission through NRI Lapsed Seats? If yes, when and how?'],
                    ['faq', 'If you are placed on the Wait List, do you still have a chance of getting an MBBS seat? What should you do next?'],
                    ['cta', '📞 Don\'t miss the right admission opportunity. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts to understand the best seat category for your NEET score.'],
                ],
            ],
            [
                'heading' => 'Q. Fee Structure',
                'blocks' => [
                    ['alert', '💰 Tamil Nadu MBBS Fees – Are You Paying More Than You Need To?'],
                    ['faq', 'Why do some Tamil Nadu MBBS colleges have different tuition fees, and how do you identify the best-value option for your NEET score?'],
                    ['faq', 'What is the difference between Management Quota, NRI Quota, and NRI Lapsed Quota fees? Could choosing the wrong category cost you several lakhs more?'],
                    ['faq', 'Apart from the tuition fee, what additional expenses should you consider before taking admission into a Tamil Nadu MBBS college?'],
                    ['cta', '📞 Make an informed financial decision. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before locking your college preferences.'],
                ],
            ],
            [
                'heading' => 'R. Discontinuation of Fees',
                'blocks' => [
                    ['alert', '⚠️ Before You Resign Your MBBS Seat, Know the Consequences!'],
                    ['faq', 'Can withdrawing from your MBBS seat after the counselling cut-off cost you a ₹10 lakh Discontinuation Fee?'],
                    ['faq', 'If you\'re allotted a seat in the Final Stray Round but don\'t join, could you lose your Security Deposit, Tuition Fee, and still have to pay the Discontinuation Fee?'],
                    ['faq', 'Can your MBBS admission be cancelled even after seat allotment if your original documents or eligibility verification are found to be incomplete or incorrect?'],
                    ['cta', '📞 Don\'t risk costly mistakes. Speak with ADCB\'s Tamil Nadu MBBS Counselling Experts before making any admission or resignation decision.'],
                ],
            ],
            [
                'heading' => 'S. FAQ Regarding Counselling Procedures',
                'blocks' => [
                    ['faq', 'Why do some Management Quota seats become available only in later counselling rounds?'],
                    ['faq', 'Can an NRI seat later become available for Management Quota candidates?'],
                    ['faq', 'Why do candidates with similar NEET scores often get different colleges?'],
                    ['faq', 'What happens if you don\'t download your allotment order on time?'],
                    ['faq', 'Can changing just one preference during choice filling improve your allotment?'],
                    ['faq', 'Are Minority seats available only to Minority candidates throughout counselling?'],
                    ['faq', 'Why do some seats suddenly appear in Round 2 or Round 3 even though they weren\'t available earlier?'],
                ],
            ],
            [
                'heading' => 'T. Annexures',
                'blocks' => [
                    ['alert', '“Do You Have the Correct Minority Certificate?”'],
                    ['alert', '“Who Can Actually Sponsor You Under NRI Quota?”'],
                    ['alert', '“One Missing Annexure Can Lead to Rejection”'],
                    ['cta', 'Not sure which certificates, annexures or declarations apply to your case?', 'Get your complete eligibility and document checklist verified by ADCB before submitting your application.'],
                ],
            ],
        ];

        $html = '';
        foreach ($sections as $section) {
            $html .= '<h2>'.$section['heading'].'</h2>';
            $html .= $this->renderBlocks($section['blocks']);
        }

        return $html;
    }

    /**
     * Render a list of content blocks to HTML.
     *
     * @param  array<int, array<int, string>>  $blocks
     */
    private function renderBlocks(array $blocks): string
    {
        $html = '';

        foreach ($blocks as $block) {
            $type = $block[0];

            if ($type === 'faq') {
                $html .= '<ul><li><strong>'.$this->esc($block[1]).'</strong></li></ul>';
            } elseif ($type === 'warn') {
                $html .= '<p class="warn"><span class="icon">⚠️</span> '.$this->esc($block[1]).'</p>';
            } elseif ($type === 'alert') {
                $html .= '<div class="alert"><p>'.$this->esc($block[1]).'</p></div>';
            } elseif ($type === 'panel') {
                $html .= '<div class="panel"><h3>'.$this->esc($block[1]).'</h3><p>'.$this->esc($block[2]).'</p></div>';
            } elseif ($type === 'cta') {
                $html .= $this->renderCta($block);
            }
        }

        return $html;
    }

    /**
     * @param  array<int, string>  $block
     */
    private function renderCta(array $block): string
    {
        if (isset($block[2])) {
            return '<blockquote><p class="cta-title">'.$this->esc($block[1]).'</p><p>'.$this->esc($block[2]).'</p></blockquote>';
        }

        return '<blockquote><p>'.$this->esc($block[1]).'</p></blockquote>';
    }

    private function esc(string $text): string
    {
        return str_replace(["\r\n", "\n"], '<br>', htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false));
    }
}
