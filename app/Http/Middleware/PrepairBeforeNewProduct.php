<?php

namespace App\Http\Middleware;

use App\Category;
use App\Supplier;
use App\Warehouse;
use Closure;

class PrepairBeforeNewProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (count(Warehouse::latest()->get()) < 1) {
            return redirect(route('warehouse.create'))
                ->with(
                    'warning',
                    __('Prepare warehouse before creating new product step 1')
                );
        }
        if (count(Supplier::latest()->get()) < 1) {
            return redirect(route('supplier.create'))
                ->with(
                    'warning',
                    __('Prepare supplier before creating new product step 2')
                );
        }
        if (count(Category::latest()->get()) < 1) {
            return redirect(route('category.create'))
                ->with(
                    'info',
                    __('Prepare category before creating new product step 3')
                );
        }
        return $next($request);
    }
}
