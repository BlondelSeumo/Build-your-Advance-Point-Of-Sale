<?php

/**
 * This file implements Expense Report Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  ExpenseReportController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Expense;

/**
 * Controls the data flow into a Expense Report object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  ExpenseReportController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class ExpenseReportController extends Controller
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
    Generate Yearly Expense collection for chart

    @return \Illuminate\View\View.
     */
    public function expenseSummary()
    {
        $this->authorize('summary', Expense::class);
        $expenseData = $this->_sumUpData();
        $orders = $this->_totalVouchers();
        $amount = $this->_expenseAmonut();
        return view(
            'finance.expense.detail',
            compact(
                [
                    'expenseData', 'orders', 'amount',
                ]
            )
        );
    }

    /**
     * Over all expense summary
     *
     * @return Array
     */
    private function _sumUpData()
    {
        $expenses = Expense::latest()->get();
        return [
            'amount' => $expenses->count(),
            'orders' => collect($expenses)->sum('amount'),
        ];
    }

    /**
     * Calculates expense amount by month
     *
     * @return String
     */
    private function _expenseAmonut()
    {
        $amount = [];
        for ($month = 1; $month < 13; $month++) {
            $amount[$month] = $this->intoKillo(
                Expense::whereYear('created_at', Date('Y'))
                    ->whereMonth('created_at', (string) $month)
                    ->sum('amount')
            );
        }
        return implode(', ', $amount);
    }

    /**
     * Count expense voucher by month
     *
     * @return String
     */
    private function _totalVouchers()
    {
        $total = [];
        for ($i = 1; $i < 13; $i++) {
            $total[$i] = Expense::whereYear('created_at', Date('Y'))
                ->whereMonth('created_at', (string) $i)
                ->count('id');
        }
        return implode(', ', $total);
    }
}
