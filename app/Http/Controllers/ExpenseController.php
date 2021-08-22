<?php

/**
 * This file implements Expense Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  CategoryController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\DataTables\ExpenseDataTable;
use App\Events\LogActivity;
use App\Expense;
use App\Http\Requests\AttachmentRequest;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controls the data flow into a expense object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  ExpenseController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class ExpenseController extends Controller
{

    /**
     * Constructs a new instance.
     * Middleware Applied
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Expense list loads debatable, give access to management.
     *
     * @param \App\DataTables\ExpenseDataTable $dataTable The data table
     *
     * @return \Illuminate\View\View
     */
    public function index(ExpenseDataTable $dataTable)
    {
        $this->authorize('manage', Expense::class);
        return $dataTable->render('management.expenses.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Expense::class);
        return view('entries.expense.create');
    }

    /**
     * Show the form for creating a new resource
     *
     * @param \App\Http\Requests\ExpenseRequest $request The request
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function store(ExpenseRequest $request)
    {
        $this->authorize('create', Expense::class);
        $validated = $request->validated();
        $validated['reference'] = time();
        $validated['by'] = auth()->user()->name;
        $expense = Expense::create($validated);
        event(
            new LogActivity(
                $expense->reference,
                ' ' . __('Data saved successfully'),
                __('Expense')
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
     * @param \App\Expense $expense The expense
     *
     * @return \Illuminate\View\View
     */
    public function show(Expense $expense)
    {
        $this->authorize('manage', Expense::class);
        return view('management.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Expense $expense The expense
     *
     * @return \Illuminate\View\View
     */
    public function edit(Expense $expense)
    {
        $this->authorize('manage', Expense::class);
        return view('management.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ExpenseRequest $request The request
     * @param \App\Expense                      $expense The expense
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->authorize('manage', Expense::class);
        $expense->update($request->validated());
        event(
            new LogActivity(
                $expense->reference,
                ' ' . __('Data updated successfully'),
                __('Expense')
            )
        );
        return response()->json(
            ['message' => __('Data updated successfully')],
            200
        );
    }

    /**
     * Destroys the given expense.
     *
     * @param \App\Expense $expense The expense
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('manage', Expense::class);
        $this->checkLogoExistence($expense->attachment);
        event(
            new LogActivity(
                $expense->reference,
                ' ' . __('Data removed successfully'),
                __('Expense')
            )
        );
        $expense->delete();
        return redirect(route('expense.index'))
            ->with('success', __('Data removed successfully'));
    }

    /**
     * Print the given expense.
     *
     * @param \App\Expense $expense The expense
     *
     * @return \Illuminate\View\View.
     */
    function print(Expense $expense)
    {
        return view('management.expenses.print', compact('expense'));
    }

    /**
     * Attachment for expense voucher
     *
     * @param AttachmentRequest $request The request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function image(AttachmentRequest $request)
    {
        $this->authorize('manage', Expense::class);
        $expense = Expense::find($request->expense_id);
        $this->checkLogoExistence($expense->attachment);
        $attachment = $request->attachment->store('uploads/expenses', 'public');
        event(
            new LogActivity(
                $expense->reference,
                ' ' . __('Expense Voucher Attachment'),
                __('Expense')
            )
        );
        $expense->update(['attachment' => $attachment]);
        return back()->with('success', __('Data updated Successfully'));
    }
}
