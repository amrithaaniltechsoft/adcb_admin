<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            'MBBS' => [
                'code' => 'MBBS',
                'title' => 'Bachelor of Medicine & Surgery',
                'description' => 'Foundation of medical excellence. The gateway to a career in clinical medicine and healthcare leadership.',
                'image' => '/course-img/mbbs.jpg',
                'href' => '/mbbs',
                'sort_order' => 1,
                'featured' => true,
            ],
            'MD/MS' => [
                'code' => 'MD/MS',
                'title' => 'Doctor of Medicine / Master of Surgery',
                'description' => 'Advanced clinical specialisation across medical and surgical disciplines for physicians seeking mastery.',
                'image' => '/course-img/md-ms.jpg',
                'href' => '/md-ms/kerala',
                'sort_order' => 2,
                'featured' => true,
            ],
            'MDS' => [
                'code' => 'MDS',
                'title' => 'Master of Dental Surgery',
                'description' => 'Premier dental specialisation covering nine clinical and non-clinical branches for dentistry excellence.',
                'image' => '/course-img/mds.jpg',
                'href' => '/mds/conservative-dentistry',
                'sort_order' => 3,
                'featured' => true,
            ],
            'DNB' => [
                'code' => 'DNB',
                'title' => 'Diplomate of National Board',
                'description' => null,
                'image' => null,
                'href' => null,
                'sort_order' => null,
                'featured' => false,
            ],
        ];

        Course::query()->whereNotIn('name', array_keys($courses))->delete();

        foreach ($courses as $name => $data) {
            Course::updateOrCreate(['name' => $name], $data);
        }
    }
}
