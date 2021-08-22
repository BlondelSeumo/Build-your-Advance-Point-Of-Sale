<?php

/**
 * This file implements Setting Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  SettingController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\Language;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * Controls the data flow into a Setting object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  SettingController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class SettingController extends Controller
{
    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('demoCheck')->only('mail', 'image');
    }

    /**
     * Display current setting ,gives access to change,
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', Setting::class);
        $setting = $this->bluePrints();
        $langs = Language::get();
        return view('setting.setting', compact(['setting', 'langs']));
    }

    /**
     * Email configuration
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Setting             $setting The setting
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function mail(Request $request, Setting $setting)
    {
        $this->authorize('mail', Setting::class);
        $validated = $this->validate(
            $request,
            [
                'mail_driver' => 'required',
                'mail_host' => 'required',
                'mail_port' => 'required|numeric',
                'mail_user' => 'required',
                'mail_password' => 'required',
                'mail_encryption' => 'required',
            ]
        );
        $setting->update($validated);
        event(
            new LogActivity(
                __('Mail'),
                ' ' . __('Mail configuration updated'),
                __('Setting')
            )
        );
        Artisan::call('optimize:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        return response()->json(
            [
                'type' => 'success',
                'message' => __('Mail configuration updated'),
            ],
            200
        );
    }

    /**
     * General Setting
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Setting             $setting The setting
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function update(Request $request, Setting $setting)
    {
        $this->authorize('general', $setting);
        $validate = $this->validate(
            $request,
            [
                'default_email' => 'required|email',
                'address_1' => 'required',
                'site_name' => 'required',
                'skin' => 'required',
                'address_2' => 'required',
                'phone' => 'required',
                'refund_prefix' => 'required|regex:/^[A-Z]+$/|max:10',
                'registration_number' => 'required',
                'currency' => 'required',
                'sale_prefix' => 'required|regex:/^[A-Z]+$/|max:10',
                'purchase_prefix' => 'required|regex:/^[A-Z]+$/|max:10',
                'vat' => 'required',
                'default_group' => 'required',
                'locale' => 'required',
            ]
        );
        $setting->update($validate);
        event(
            new LogActivity(
                __('General'),
                ' ' . __('General setting updated'),
                'Setting'
            )
        );
        return response()->json(
            [
                'type' => 'success',
                'message' => __('Setting updated'),
            ],
            200
        );
    }

    /**
     * Main logo
     *
     * @param Request $request The request
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function image(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|file',
            ]
        );
        $this->authorize('logo', $this->bluePrints());
        $this->checkLogoExistence($this->bluePrints()->image);
        $image = $request->image->store('uploads/setting', 'public');
        $this->bluePrints()->update(['image' => $image]);
        event(
            new LogActivity(
                __('Logo'),
                ' ' . __('Main logo updated'),
                __('Setting')
            )
        );
        return back()->with('success', __('Updated successfully'));
    }

    /**
     * Sets Profuct Defaults
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Setting             $setting The setting
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function product(Request $request, Setting $setting)
    {
        $this->authorize('productDefaults', Setting::class);
        $validated = $this->validate(
            $request,
            [
                'status' => 'required',
                'discountable' => 'required',
                'tax' => 'required|numeric',
                'barcode_symbology' => 'required',
                'alert_quantity' => 'required',
            ]
        );
        $setting->update($validated);
        event(
            new LogActivity(
                __('Product defaults'),
                ' ' . __('Product default updated'),
                __('Setting')
            )
        );
        return response()->json(
            [
                'type' => 'success',
                'message' => __('Product default configuration updated'),
            ],
            200
        );
    }

    /**
     * Sets Inventory Impacts
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Setting             $setting The setting
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function impact(Request $request, Setting $setting)
    {
        $this->authorize('impects', Setting::class);
        $validated = $this->validate(
            $request,
            [
                'dead_level' => 'required',
                'high_level' => 'required',
                'medium_level' => 'required|numeric',
                'low_level' => 'required',
                'normal_level' => 'required',
            ]
        );
        $setting->update($validated);
        event(
            new LogActivity(
                __('Inventory impacts'),
                ' ' . __('Impacts levels updated'),
                'Setting'
            )
        );
        return response()->json(
            [
                'type' => 'success',
                'message' => __('Inventory impacts levels updated'),
            ],
            200
        );
    }

    /**
     * Point of sale configuration
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Setting             $setting The setting
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function pos(Request $request, Setting $setting)
    {
        $this->authorize('pos', Setting::class);
        $valid = $this->validate(
            $request,
            [
                'qty_show' => 'required',
                'name_show' => 'required',
                'price_show' => 'required',
                'default_customer' => 'required|numeric',
                'default_tax' => 'required',
                'default_payment' => 'required',
                'discount_state' => 'required',
                'product_icon_skin' => 'required',
                'default_category' => 'required',
                'product_limit' => 'required',
                'quick_amounts' => 'required|regex:/^([0-9\s]+,)*([0-9\s]+){1}$/i',
            ]
        );
        $setting->update($valid);
        event(
            new LogActivity(
                __('Pos config'),
                ' ' . __('POS configuration updated'),
                __('Setting')
            )
        );
        return response()->json(
            [
                'type' => 'success',
                'message' => __('POS configuration updated'),
            ],
            200
        );
    }
}
