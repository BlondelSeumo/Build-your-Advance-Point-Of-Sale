<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            '*',
            \App\Http\View\Composers\SettingComposer::class
        );
        View::composer(
            [
                'entries.product.create',
                'management.products.edit'
            ],
            \App\Http\View\Composers\WarehouseComposer::class
        );
        View::composer(
            [
                'entries.subcategory.create',
                'management.subcategories.edit'
            ],
            \App\Http\View\Composers\SubcategoryFormComposer::class
        );
        View::composer(
            [
                'entries.purchase.create',
                'entries.product.create',
                'management.products.edit',
            ],
            \App\Http\View\Composers\SupplierComposer::class
        );
        View::composer(
            [
                'dashboard',
            ],
            \App\Http\View\Composers\DashboardComposer::class
        );
        View::composer(
            [
                'auth.edit',
                'auth.register',
                'auth.list',
                'setting.setting',
                'group.list'
            ],
            \App\Http\View\Composers\GroupsComposer::class
        );
        View::composer(
            [
                'portal.chapters.create'
            ],
            \App\Http\View\Composers\UsersComposer::class
        );
        View::composer(
            [
                'layouts.pos',
            ],
            \App\Http\View\Composers\OpenedChapterComposer::class
        );
        View::composer(
            [
                'setting.setting',
            ],
            \App\Http\View\Composers\UsersComposer::class
        );
        View::composer(
            [
                'setting.setting',
                'entries.product.create',
                'entries.purchase.create',
                'management.products.edit',
            ],
            \App\Http\View\Composers\TaxComposer::class
        );
        View::composer(
            [
                'setting.setting',
                'entries.product.create',
                'management.products.edit',
            ],
            \App\Http\View\Composers\CategoryComposer::class
        );
        View::composer(
            [
                'setting.setting',
            ],
            \App\Http\View\Composers\PaymentComposer::class
        );
        View::composer(
            [
                'setting.setting',
            ],
            \App\Http\View\Composers\CustomerComposer::class
        );
    }
}
