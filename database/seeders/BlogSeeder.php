<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'NEET UG 2025: Counselling Process & Mandatory Documents',
                'slug' => 'neet-ug-2025-counselling-guide',
                'excerpt' => 'Everything you need to know about state and national NEET UG counselling, including registration, choice filling, and essential document verification.',
                'category' => 'NEET UG / MBBS',
                'date' => 'Aug 02, 2026',
                'read_time' => '5 min read',
                'image' => '/page-banner/mbbs-middle1.jpg',
                'tags' => "NEET UG\nCounselling\nMBBS",
                'author' => 'Dr. Rachel Thomas',
                'content' => <<<HTML
<p>Navigating the NEET UG counselling process can feel overwhelming for aspiring medical students. With multiple rounds, strict timelines, and varying rules across national (MCC) and state authorities, keeping track of every detail is critical. This comprehensive guide outlines the step-by-step counselling workflow and lists all mandatory documents you need to secure your MBBS seat.</p>

<h3>1. The Counselling Phases</h3>
<p>NEET UG counselling is typically conducted in four main rounds:</p>
<ul>
  <li><strong>Round 1:</strong> Initial registration, choice filling, locking, and seat allocation. Upgradation options are available.</li>
  <li><strong>Round 2:</strong> Fresh registration is allowed. Upgraded candidates and new applicants fill fresh choices.</li>
  <li><strong>Round 3 (Mop-up Round):</strong> Conducted to fill remaining seats. Rules regarding seat forfeiture become stricter.</li>
  <li><strong>Stray Vacancy Round:</strong> The final round conducted online/offline to fill any vacant seats. No fresh registration is allowed in some cases.</li>
</ul>

<h3>2. Essential Documents Checklist</h3>
<p>Ensure you have at least 3-4 sets of photocopies along with original copies of the following documents:</p>
<ul>
  <li>NEET UG Admit Card &amp; Scorecard</li>
  <li>Class 10 Mark Sheet &amp; Passing Certificate (for Date of Birth proof)</li>
  <li>Class 12 Mark Sheet &amp; Passing Certificate</li>
  <li>ID Proof (Aadhar Card, Passport, or PAN Card)</li>
  <li>Category Certificate (SC/ST/OBC/EWS, if applicable)</li>
  <li>Domicile/Nativity Certificate (for state quota seats)</li>
  <li>Transfer Certificate (TC) &amp; Migration Certificate</li>
  <li>Recent passport-size photographs (matching the NEET application form)</li>
</ul>

<h3>3. Choice Filling Strategy</h3>
<p>When filling choices, always order your preferences with premium government colleges first, followed by top-tier private and deemed universities. Research the clinical patient load, campus infrastructure, and tuition bond details before locking your selections.</p>
HTML,
            ],
            [
                'title' => 'MDS Admissions 2026: Top Specializations and Career Scope',
                'slug' => 'mds-admissions-top-branches-scope',
                'excerpt' => 'Deep dive into MDS clinical and non-clinical branches. Find out which dental specializations have the highest career scope and market demand.',
                'category' => 'NEET PG / MDS',
                'date' => 'Jul 28, 2026',
                'read_time' => '4 min read',
                'image' => '/courses/mds.jpg',
                'tags' => "MDS\nDental\nSpecializations",
                'author' => 'Prof. K. Rajan',
                'content' => <<<HTML
<p>A Master of Dental Surgery (MDS) is the ideal pathway for dental graduates seeking clinical expertise and career advancement. However, choosing the right specialization is one of the most critical decisions a dentist will make. In this post, we discuss the top clinical branches in MDS and their prospective career scopes.</p>

<h3>1. Prosthodontics &amp; Crown &amp; Bridge</h3>
<p>Focuses on dental prosthetics, implantology, and aesthetic dentistry. High demand in private practice and corporate clinic environments due to the rising interest in smile makeovers and dental implants.</p>

<h3>2. Orthodontics &amp; Dentofacial Orthopedics</h3>
<p>Concerns the correction of misaligned teeth and jaws. It is one of the most lucrative and popular non-surgical specialties, allowing dentists to establish highly successful exclusive orthodontic clinics.</p>

<h3>3. Oral &amp; Maxillofacial Surgery</h3>
<p>The bridge between dentistry and medicine. OMFS surgeons handle complex extractions, facial trauma, jaw reconstruction, and cleft surgeries. It offers intense hospital-based clinical practice and outstanding prestige.</p>

<h3>4. Conservative Dentistry &amp; Endodontics</h3>
<p>Root canals and cosmetic dental fillings represent the core patient volume of any general dental practice. Specializing in Endodontics ensures a steady stream of referrals and consulting opportunities.</p>

<h3>5. Pediatric &amp; Preventive Dentistry</h3>
<p>With parents prioritizing child healthcare, specialized pediatric dental care is a rapidly growing market. Pediatric dentists specialize in child behavior management and dental treatments under general anesthesia.</p>
HTML,
            ],
            [
                'title' => 'Study MBBS Abroad: Best Countries, Fees & Licensing Exams',
                'slug' => 'mbbs-abroad-eligibility-licensing',
                'excerpt' => 'A complete analysis of studying medicine in countries like UAE, Uzbekistan, and Georgia, covering tuition fees and FMGE/NExT screening exams.',
                'category' => 'Study Abroad',
                'date' => 'Jul 15, 2026',
                'read_time' => '6 min read',
                'image' => '/page-banner/uae-banner.jpg',
                'tags' => "MBBS Abroad\nLicensing\nNExT",
                'author' => 'Advisory Council, ADCB',
                'content' => <<<HTML
<p>Aspiring medical students who face high cutoffs or high private college tuition fees in India often look to study MBBS abroad. Modern medical universities overseas offer international standards of education, english-medium curriculums, and globally recognized degrees at a fraction of the cost.</p>

<h3>1. Top Destinations for MBBS Abroad</h3>
<ul>
  <li><strong>Georgia:</strong> Known for European standards, safe environment, and direct clinical exposure. Universities are recognized by WHO and the National Medical Commission (NMC).</li>
  <li><strong>Uzbekistan:</strong> Affordable tuition fees, low cost of living, and close cultural ties. Many colleges now employ Indian faculty members.</li>
  <li><strong>UAE:</strong> State-of-the-art medical equipment, cosmopolitan lifestyle, and high-quality hospital training, ideal for students seeking paths to the US, UK, or Gulf region.</li>
</ul>

<h3>2. Key Eligibility Criteria</h3>
<p>To study medicine abroad and remain eligible to practice in India, candidates must:</p>
<ul>
  <li>Have qualified the NEET-UG exam in the year of admission.</li>
  <li>Have completed Class 12 with Physics, Chemistry, Biology, and English, securing at least 50% marks (40% for reserved categories).</li>
  <li>Be at least 17 years of age by December 31st of the admission year.</li>
</ul>

<h3>3. Licensing and the NExT Exam</h3>
<p>As per the latest NMC regulations, all students graduating with an foreign medical degree must pass the National Exit Test (NExT) to obtain a license to practice medicine in India and secure post-graduate admissions.</p>
HTML,
            ],
            [
                'title' => 'How to Secure an MBBS Seat Under NRI/Management Quotas',
                'slug' => 'management-nri-quota-mbbs-admission',
                'excerpt' => 'Understanding the eligibility criteria, document requirements, and counselling protocols to qualify for private college NRI and Management quotas.',
                'category' => 'Admissions Info',
                'date' => 'Jun 30, 2026',
                'read_time' => '5 min read',
                'image' => '/page-banner/mbbs-middle4.jpg',
                'tags' => "Management Quota\nNRI Quota\nAdmissions",
                'author' => 'Sherin George, Head of Admissions',
                'content' => <<<HTML
<p>For NEET UG candidates who do not secure government quota seats, private medical colleges and deemed universities offer valuable opportunities through Management and Non-Resident Indian (NRI) quotas. Although these seats carry higher tuition fees, understanding the specific entry rules can help you plan your finances and admission pathway effectively.</p>

<h3>1. What is the NRI Quota?</h3>
<p>Under Supreme Court directives, private and deemed colleges reserve up to 15% of their total seats for NRI candidates. NRI sponsors (parents, siblings, or close relatives) can sponsor candidates, provided they present valid overseas documents during registration.</p>

<h3>2. Crucial Documents for NRI Quota Eligibility</h3>
<ul>
  <li>Sponsor&rsquo;s Embassy Certificate or Consulate Letter.</li>
  <li>Copy of Sponsor&rsquo;s Passport &amp; Visa/Green Card.</li>
  <li>Relationship Affidavit (stating the link between the candidate and the sponsor).</li>
  <li>NEET UG scorecard and registration receipt.</li>
  <li>Bank account statement of the NRI sponsor showing foreign remittance.</li>
</ul>

<h3>3. Management Quota Counselling</h3>
<p>Management Quota seats (often designated as Category B or C in states like Telangana and Andhra Pradesh) are filled through open state counselling rounds. Candidates must qualify NEET and register during the state's counselling application window to be considered.</p>
HTML,
            ],
            [
                'title' => 'Expert Tips for NEET PG Choice Filling and College Preferences',
                'slug' => 'understanding-neet-pg-choice-filling',
                'excerpt' => 'Maximize your chances of landing a desired PG specialty by avoiding common pitfalls during choice filling in state and MCC counselling.',
                'category' => 'NEET PG / MDS',
                'date' => 'Jun 12, 2026',
                'read_time' => '4 min read',
                'image' => '/courses/md-ms.jpg',
                'tags' => "NEET PG\nChoice Filling\nMD MS",
                'author' => 'Dr. Rachel Thomas',
                'content' => <<<HTML
<p>The difference between a doctor securing their dream specialty and missing out often boils down to a single factor: choice filling strategy. Even with a high NEET PG score, poor choice ordering or neglecting seat matrices can lead to disappointment. Here are expert strategies to guide your preference list.</p>

<h3>1. Analyzing the Seat Matrix</h3>
<p>Before filling a single choice, study the seat matrix released by MCC and state counselling bodies. Note the distribution of clinical seats, category-specific quotas, and historically vacant positions across institutions.</p>

<h3>2. Establish Your Priority: Branch vs. College</h3>
<p>Decide whether your absolute priority is the specialty branch (e.g., Radio-Diagnosis, General Medicine) or the college branding (e.g., prestigious central institutes). For clinical specialities, patient inflow and hands-on exposure at the hospital are far more critical than fancy campus buildings.</p>

<h3>3. Understand the Free Exit &amp; Security Deposit Forfeiture Rules</h3>
<ul>
  <li><strong>Round 1:</strong> Generally features a free exit. If you are allotted a seat but do not join, you can participate in Round 2 without penalty.</li>
  <li><strong>Round 2 &amp; 3:</strong> Exiting an allotted seat in these rounds will lead to forfeiture of your security deposit, and in later rounds, you may be barred from further counselling.</li>
</ul>
HTML,
            ],
            [
                'title' => 'Top Private and Government Medical Colleges in South India',
                'slug' => 'top-medical-colleges-south-india',
                'excerpt' => 'A comprehensive review of the infrastructure, patient load, clinical exposure, and fee structures of premium medical colleges in Kerala, Karnataka, and Tamil Nadu.',
                'category' => 'Admissions Info',
                'date' => 'May 25, 2026',
                'read_time' => '7 min read',
                'image' => '/page-banner/mbbs-middle2.jpg',
                'tags' => "Medical Colleges\nKerala\nKarnataka",
                'author' => 'Advisory Council, ADCB',
                'content' => <<<HTML
<p>South India has established itself as the hub of medical education excellence in the country. With well-established government medical colleges and high-quality private universities, the region attracts students from all over India. We highlight some of the most sought-after medical schools in these states.</p>

<h3>1. Kerala: The Clinical Exposure Hub</h3>
<p>Kerala's government medical colleges, like GMC Trivandrum and GMC Kozhikode, are renowned for heavy patient load and rich clinical cases. Private institutions, such as Amrita School of Medicine, offer state-of-the-art diagnostic facilities and premium teaching setups.</p>

<h3>2. Karnataka: Deemed University Capital</h3>
<p>Karnataka features a high concentration of premium deemed medical universities, including Kasturba Medical College (KMC Manipal) and JSS Medical College. These colleges are recognized globally for research output and world-class hospital training facilities.</p>

<h3>3. Tamil Nadu: Premier State Quota &amp; Research</h3>
<p>Madras Medical College (MMC Chennai) stands as one of the oldest and most prestigious medical colleges in Asia. Private colleges, like Christian Medical College (CMC Vellore), set the national benchmark for medical ethics and multi-specialty clinical research.</p>
HTML,
            ],
        ];

        foreach ($posts as $post) {
            Blog::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
