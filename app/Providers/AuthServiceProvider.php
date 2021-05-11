<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Tag;
use App\Policies\CategoryPolicy;
use App\Policies\CoursePolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Question' => 'App\Policies\QuestionPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        Tag::class => TagPolicy::class,
        Course::class => CoursePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
