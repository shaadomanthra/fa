<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        \App\Models\Test\Test::class => \App\Policies\Test\TestPolicy::class,
        \App\Models\Test\Section::class => \App\Policies\Test\SectionPolicy::class,
        \App\Models\Test\Extract::class => \App\Policies\Test\ExtractPolicy::class,
        \App\Models\Test\Mcq::class => \App\Policies\Test\McqPolicy::class,
        \App\Models\Test\Fillup::class => \App\Policies\Test\FillupPolicy::class,
        \App\Models\Test\Attempt::class => \App\Policies\Test\AttemptPolicy::class,
        \App\Models\Test\Category::class => \App\Policies\Test\CategoryPolicy::class,
        \App\Models\Test\Tag::class => \App\Policies\Test\TagPolicy::class,
        \App\Models\Test\File::class => \App\Policies\Test\FilePolicy::class,
        \App\Models\Test\Group::class => \App\Policies\Test\GroupPolicy::class,
        \App\Models\Test\Type::class => \App\Policies\Test\TypePolicy::class,

        \App\Models\Test\Type::class => \App\Policies\Test\TypePolicy::class,
        
        \App\User::class => \App\Policies\User\UserPolicy::class,


        \App\Models\Product\Product::class => \App\Policies\Product\ProductPolicy::class,
        \App\Models\Product\Order::class => \App\Policies\Product\OrderPolicy::class,
        \App\Models\Product\Coupon::class => \App\Policies\Product\CouponPolicy::class,

         \App\Models\Admin\Form::class => \App\Policies\Admin\FormPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
