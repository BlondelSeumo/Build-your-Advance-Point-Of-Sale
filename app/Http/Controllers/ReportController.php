<?php

/**
 * This file implements Report Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  ReportController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\Report;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a report object and updates
 * the view whenever data changes.
 *
 * @category Class
 * @package  ReportController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', Report::class);
        $user_id = auth()->user()->id;
        if ($user_id < 2) {
            $reports = Report::latest()->paginate(11);
        } else {
            $reports = Report::latest()
                ->Where('user_id', $user_id)->paginate(11);
        }

        return view('report.saved.index', compact('reports'));
    }

    /**
     * Store a newly created resource in storage
     *
     * @param \Illuminate\Http\Request $request The request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('save', Report::class);
        $report = Report::create(
            [
                'reportData' => $request->reportData,
                'user_id' => $request->user_id,
                'type' => $request->type,
            ]
        );
        event(
            new LogActivity(
                __('Report type') . ' | ' . $request->type . ' | #' . $report->id,
                __('Report saved'),
                __('Report')
            )
        );
        return redirect(route('home'))
            ->with('success', __('Report saved successfully'));
    }

    /**
     *  Display the specified resource
     *
     * @param \App\Report $report The report
     *
     * @return \Illuminate\View\View
     */
    public function show(Report $report)
    {
        $this->authorize('view', Report::class);
        $views = [
            'sale' => 'report.sale.salePrint',
            'cost' => 'report.cost.costPrint',
            'tex' => 'report.tax.taxPrint',
        ];
        return view($views[$report->type])->with('reportCard', json_decode($report->reportData, true));
    }

    /**
     * Destroys the given report.
     *
     * @param \App\Report $report The report
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Report $report)
    {
        $this->authorize('manage', Report::class);
        $report->delete();
        event(
            new LogActivity(
                __('Report type') . ' | ' . $report->type . ' | #' . $report->id,
                __('Report deleted successfully'),
                __('Report')
            )
        );
        return redirect(route('report.index'))
            ->With('success', __('Report deleted successfully'));
    }
}
