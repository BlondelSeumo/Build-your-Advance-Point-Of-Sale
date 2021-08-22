<?php

namespace App\DataTables;

use App\Purchase;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn(
                'action',
                function ($purchase) {
                    return '<div title="' . __('View full and manage') . '">
           <a class="btn btn-sm" href="' . route('purchase.show', $purchase->id) . '">
            <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
           </a>
           </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Purchase $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Purchase $model)
    {
        return $model->newQuery()->select(['id', 'created_at', 'reference', 'total_qty', 'discount_rate', 'discount_amount', 'tax_rate', 'tax_amount', 'shipping', 'total_payment']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction()
            ->parameters();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'created_at' => ['title' => __('Created at')],
            'reference' => ['title' => __('Reference')],
            'total_qty' => ['title' => __('Total qty')],
            'discount_rate' => ['title' => __('Discount rate')],
            'discount_amount' => ['title' => __('Discount amount')],
            'tax_rate' => ['title' => __('Tax rate')],
            'tax_amount' => ['title' => __('Tax amount')],
            'shipping' => ['title' => __('Shipping')],
            'total_payment' => ['title' => __('Total payment')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Purchase_' . date('YmdHis');
    }
}
