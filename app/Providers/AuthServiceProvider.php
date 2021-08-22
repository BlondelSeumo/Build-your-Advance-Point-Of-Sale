<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
                    \App\Category::class => \App\Policies\CategoryPolicy::class,
                    \App\Subcategory::class => \App\Policies\SubcategoryPolicy::class,
                    \App\Customer::class => \App\Policies\CustomerPolicy::class,
                    \App\Product::class => \App\Policies\ProductPolicy::class,
                    \App\Supplier::class => \App\Policies\SupplierPolicy::class,
                    \App\Tax::class => \App\Policies\TaxPolicy::class,
                    \App\Warehouse::class => \App\Policies\WarehousePolicy::class,
                    \App\User::class  => \App\Policies\UserPolicy::class,
                    \App\Group::class => \App\Policies\GroupPolicy::class,
                    \App\Sale::class => \App\Policies\SalePolicy::class,
                    \App\Refund::class => \App\Policies\RefundPolicy::class,
                    \App\Setting::class => \App\Policies\MasterPolicy::class,
                    \App\Chapter::class => \App\Policies\ChapterPolicy::class,
                    \App\UserActivity::class => \App\Policies\LogsPolicy::class,
                    \App\Report::class => \App\Policies\ReportsPolicy::class,
                    \App\Payment::class => \App\Policies\PaymentPolicy::class,
                 ];

    public function boot()
    {
        $this->registerPolicies();

        //Permissions Allowed to Master User
        Gate::before(
            function ($user) {
                if ($user->id === 1) {
                    return true;
                }
            }
        );
    }
}
