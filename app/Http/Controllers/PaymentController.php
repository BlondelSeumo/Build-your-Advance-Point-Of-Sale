<?php

/**
 * This file implements Payment ontroller.
 * PHP version 7.2
 *
 * @category Class
 * @package  PaymentController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Chapter;
use App\DataTables\PaymentDataTable;
use App\Events\LogActivity;
use App\Http\Requests\PaymentRequest;
use App\Payment;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a payment object
 * and updates the view whenever data changes.
 *
 * @category Class
 * @package  PaymentController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class PaymentController extends Controller
{

    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource
     *
     * @param \App\DataTables\PaymentDataTable $dataTable The data table
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaymentDataTable $dataTable)
    {
        $this->authorize('manage', Payment::class);
        return $dataTable->render('management.payments.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Payment::class);
        return view('entries.payment.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param \App\Http\Requests\PaymentRequest $request The request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PaymentRequest $request)
    {
        $this->authorize('create', Payment::class);
        $gateway = Payment::create($request->validated());
        event(
            new LogActivity(
                $gateway->title,
                ' ' . __('Data saved successfully'),
                __('Payment')
            )
        );
        return response()->json(
            [
                'message' => __('Data saved successfully'),
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Payment $payment The payment
     *
     * @return \Illuminate\View\View
     */
    public function show(Payment $payment)
    {
        return view('management.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Payment $payment The payment
     *
     * @return \Illuminate\View\View
     */
    public function edit(Payment $payment)
    {
        $this->authorize('manage', Payment::class);
        return view('management.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param \App\Http\Requests\PaymentRequest $request The request
     * @param \App\Payment                      $payment The payment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $this->authorize('manage', Payment::class);
        $payment->update($request->validated());
        event(
            new LogActivity(
                $payment->title,
                ' ' . __('Data updated successfully'),
                __('Payment')
            )
        );
        return response()->json(
            [
                'message' => __('Data updated successfully'),
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Payment $payment The payment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('manage', Payment::class);
        if (Chapter::where('status', 1)->get()->count() > 0) {
            return back()->with(
                'message',
                __('Close all sale chapters')
            );
        }
        event(
            new LogActivity(
                $payment->title,
                ' ' . __('Data removed successfully'),
                __('Payment')
            )
        );
        $payment->delete();
        return redirect(route('payment.index'))
            ->with('success', __('Data removed successfully'));
    }

    /**
     * Toggle state
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Payment             $payment The payment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(Request $request, Payment $payment)
    {
        $this->authorize('manage', Payment::class);
        if ($request->payment_code != $payment->code) {
            return back()->with('info', __('Something went wrong try again !'));
        }
        $payment->update(['state' => $payment->state ? 0 : 1]);
        event(
            new LogActivity(
                $payment->title,
                ' ' . __('Payment gateway state toggled'),
                __('Payment')
            )
        );
        return back()->with(
            'success',
            __('Payment gateway state toggled successfully')
        );
    }

    /**
     * Display all tax methods for point of sale
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function pos()
    {
        return Payment::where('state', 1)->latest()->get();
    }
}
