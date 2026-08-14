<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->buildDynamicMenu();
    }

    private function buildDynamicMenu(): void
    {
        $this->app['events']->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $courses = Course::orderBy('name')->get();

            $courseItems = $courses->map(function (Course $course) {
                $name = strtolower(str_replace(['/', ' '], '-', $course->name));

                $route = 'courses.index';
                $active = request()->is('courses');

                if ($name === 'mbbs') {
                    $route = 'mbbs.index';
                    $active = request()->is('mbbs');
                } elseif ($name === 'mds') {
                    $route = 'mds.index';
                    $active = request()->is('mds');
                } elseif ($name === 'dnb') {
                    $route = 'dnb.index';
                    $active = request()->is('dnb');
                } elseif ($name === 'md-ms') {
                    $route = 'mdms.index';
                    $active = request()->is('mdms');
                }

                return [
                    'text' => $course->name,
                    'route' => $route,
                    'icon' => 'fas fa-fw fa-circle',
                    'active' => $active,
                ];
            })->toArray();

            $submenu = array_merge([
                [
                    'text' => 'Course List',
                    'route' => 'courses.index',
                    'icon' => 'fas fa-fw fa-list',
                    'active' => request()->is('courses'),
                ],
            ], $courseItems);

            $event->menu->addAfter('faq', [
                'text' => 'Courses',
                'icon' => 'fas fa-fw fa-book',
                'submenu' => $submenu,
            ]);
        });
    }
}
