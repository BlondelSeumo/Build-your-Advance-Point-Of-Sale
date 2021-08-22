<?php

/**
 * This file implements Warehouse Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  WarehouseController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\DataTables\WarehouseDataTable;
use App\Events\LogActivity;
use App\Http\Requests\WarehouseRequest;
use App\Warehouse;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a Warehouse object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  WarehouseController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class WarehouseController extends Controller
{
    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Warehouse debatable give access to management.
     *
     * @param \App\DataTables\WarehouseDataTable $dataTable The data table
     *
     * @return \Illuminate\View\View
     */
    public function index(WarehouseDataTable $dataTable)
    {
        $this->authorize('manage', Warehouse::class);
        return $dataTable->render('management.warehouses.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Warehouse::class);
        return view('entries.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\WarehouseRequest $request The request
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function store(WarehouseRequest $request)
    {
        $this->authorize('create', Warehouse::class);
        $warehouse = Warehouse::create($this->_validWarehouse($request));
        event(
            new LogActivity(
                $warehouse->name,
                ' ' . __('New warehouse added'),
                __('Warehouse')
            )
        );
        return response()->json(['message' => __('Warehouse registered')], 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Warehouse $warehouse The warehouse
     *
     * @return \Illuminate\View\View
     */
    public function show(Warehouse $warehouse)
    {
        $this->authorize('manage', Warehouse::class);
        return view('management.warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Warehouse $warehouse The warehouse
     *
     * @return \Illuminate\View\View
     */
    public function edit(Warehouse $warehouse)
    {
        $this->authorize('manage', Warehouse::class);
        return view('management.warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\WarehouseRequest $request   The request
     * @param \App\Warehouse                      $warehouse The warehouse
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $this->authorize('manage', Warehouse::class);
        $warehouse->update($this->_validWarehouse($request));
        event(
            new LogActivity(
                $warehouse->name,
                ' ' . __('Warehouse information updated'),
                __('Warehouse')
            )
        );
        return response()->json(
            [
                'message' => __('Warehouse information updated'),
            ],
            200
        );
    }

    /**
     * Destroys the given warehouse.
     *
     * @param \App\Warehouse $warehouse The warehouse
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function destroy(Warehouse $warehouse)
    {
        $this->authorize('manage', Warehouse::class);
        if ($warehouse->products->count() > 0) {
            return back()->with('warning', __('Warehouse has products'));
        }
        event(
            new LogActivity(
                $warehouse->name,
                ' ' . __('Warehouse removed'),
                __('Warehouse')
            )
        );
        $warehouse->delete();
        return redirect(route('warehouse.index'))
            ->with('success', __('Warehouse destroyed'));
    }

    /**
     * Gives valid warehouse
     *
     * @param Request $request The request
     *
     * @return array
     */
    private function _validWarehouse($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'code' => $this->generateCode($request),
            'address' => $request->address,
        ];
    }
}
