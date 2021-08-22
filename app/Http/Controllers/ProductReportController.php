<?php

/**
 * This file implements Product Report Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  ProductReportController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\Product;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a Product Report object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  ProductReportController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class ProductReportController extends Controller
{

    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate Product low quantity alert
     *
     * @param \Illuminate\Http\Request $request The request
     *
     * @return \Illuminate\View\View
     */
    public function inventory(Request $request)
    {
        $this->authorize('report', \App\Product::class);
        $products = $this->_impact(
            Product::whereRaw('alert_quantity >= qty')
                ->get()
        );

        //for print
        if ('yes' === $request->print) {
            return view('report.inventoryPrint')
                ->with('products', $products);
        }
        event(
            new LogActivity(
                __('Out of stock items') . ' ' . $products->count(),
                __('Inventory alerts viewed'),
                __('Inventory')
            )
        );
        return view('report.inventory')->with('products', $products);
    }

    /**
     * Sets Impacts to product
     *
     * @param mixed $products The products
     *
     * @return mixed
     */
    private function _impact($products)
    {
        $setting = $this->bluePrints();
        foreach ($products as $product) {
            $product['impact'] = __('Ignore');
            if ($product->qty <= $setting->dead_level) {
                $product['impact'] = __('Dead');
            }
            if ($product->qty <= $setting->high_level) {
                $product['impact'] = __('High');
            }
            if ($product->qty <= $setting->medium_level) {
                $product['impact'] = __('Medium');
            }
            if ($product->qty <= $setting->low_level) {
                $product['impact'] = __('Low');
            }
            if ($product->qty <= $setting->normal_level) {
                $product['impact'] = __('Normal');
            }
        }
        return $products;
    }
}
