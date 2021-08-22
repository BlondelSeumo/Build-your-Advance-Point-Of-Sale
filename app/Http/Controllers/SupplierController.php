<?php

/**
 * This file implements Supplier Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  SupplierController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Events\LogActivity;
use App\Http\Requests\SupplierRequest;
use App\Supplier;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a Supplier object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  SupplierController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class SupplierController extends Controller
{

    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Supplier debatable give access to management.
     *
     * @param \App\DataTables\SupplierDataTable $dataTable The data table
     *
     * @return \Illuminate\View\View
     */
    public function index(SupplierDataTable $dataTable)
    {
        $this->authorize('manage', Supplier::class);
        return $dataTable->render('management.suppliers.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Supplier::class);
        return view('entries.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\SupplierRequest $request The request
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function store(SupplierRequest $request)
    {
        $this->authorize('create', Supplier::class);
        $supplier = Supplier::create($request->validated());
        event(
            new LogActivity(
                $supplier->name,
                ' ' . __('Data saved successfully'),
                'supplier'
            )
        );
        return response()->json(['message' => __('Data saved successfully')], 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Supplier $supplier The supplier
     *
     * @return \Illuminate\View\View
     */
    public function show(Supplier $supplier)
    {
        $this->authorize('manage', Supplier::class);
        return view('management.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Supplier $supplier The supplier
     *
     * @return \Illuminate\View\View
     */
    public function edit(Supplier $supplier)
    {
        $this->authorize('manage', Supplier::class);
        return view('management.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\SupplierRequest $request  The request
     * @param \App\Supplier                      $supplier The supplier
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $this->authorize('manage', Supplier::class);
        $supplier->update($request->validated());
        event(
            new LogActivity(
                $supplier->name,
                ' ' . __('Data updated successfully'),
                __('Supplier')
            )
        );
        return response()->json(
            ['message' => __('Data updated successfully')],
            200
        );
    }

    /**
     * Destroys the given supplier.
     *
     * @param \App\Supplier $supplier The supplier
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function destroy(Supplier $supplier)
    {
        $this->authorize('manage', Supplier::class);
        if ($supplier->purchases->count() > 0 || $supplier->products->count() > 0) {
            return back()->with('warning', __('Supplier has purchases or products'));
        }
        $supplier->delete();
        event(
            new LogActivity(
                $supplier->name,
                ' ' . __('Data removed successfully'),
                __('Supplier')
            )
        );
        return redirect(route('supplier.index'))
            ->with('success', __('Data removed successfully'));
    }
}
