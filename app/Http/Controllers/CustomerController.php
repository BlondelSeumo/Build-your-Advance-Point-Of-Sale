<?php

/**
 * This file implements Customer Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  CustomerController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Customer;
use App\DataTables\CustomerDataTable;
use App\Events\LogActivity;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a customer object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  CustomerController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class CustomerController extends Controller
{

    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Customer debatable give access to management
     *
     * @param \App\DataTables\CustomerDataTable $dataTable The data table
     *
     * @return \Illuminate\View\View
     */
    public function index(CustomerDataTable $dataTable)
    {
        $this->authorize('manage', Customer::class);
        return $dataTable->render('management.customers.list');
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Customer::class);
        return view('entries.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Validate
     *
     * @param \App\Http\Requests\CustomerRequest $request The request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerRequest $request)
    {
        $this->authorize('create', Customer::class);
        $customer = Customer::create($request->validated());
        event(
            new LogActivity(
                $customer->name,
                __('Data saved successfully'),
                __('Customer')
            )
        );
        return response()->json(
            ['message' => __('Data saved successfully')],
            200
        );
    }

    /**
     * Display the specified resource
     *
     * @param \App\Customer $customer The customer
     *
     * @return \Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        $this->authorize('manage', Customer::class);
        return view('management.customers.show', compact('customer'));
    }

    /**
     * Edit $customer
     *
     * @param \App\Customer $customer The customer
     *
     * @return \Illuminate\View\View
     */
    public function edit(Customer $customer)
    {
        $this->authorize('manage', Customer::class);
        return view('management.customers.edit', compact('customer'));
    }

    /**
     * Update $customer after validation success.
     *
     * @param \App\Http\Requests\CustomerRequest $request  The request
     * @param \App\Customer                      $customer The customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('manage', Customer::class);
        $customer->update($request->validated());
        event(
            new LogActivity(
                $customer->name,
                __('Data updated successfully'),
                __('Customer')
            )
        );
        return response()->json(
            ['message' => __('Data updated successfully')],
            200
        );
    }

    /**
     * Destroys the given customer.
     * Check $customer has sale orders
     * Check $customer is default
     *
     * @param \App\Customer $customer The customer
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('manage', Customer::class);
        if ($customer->sales->count() > 0) {
            return back()->with('warning', __('Customer has sales orders'));
        }
        if (1 === $customer->id) {
            return back()->with('warning', __('Walk in customer is default'));
        }
        event(
            new LogActivity(
                $customer->name,
                '' . __('Data removed successfully'),
                __('Customer')
            )
        );
        $customer->delete();
        return redirect(route('customer.index'))
            ->with('success', __('Data removed successfully'));
    }

    /**
     * Gives all Customer for point of sale.
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function customers()
    {
        $customers = Customer::latest()->get();
        return response()->json(
            $customers,
            200
        );
    }
}
