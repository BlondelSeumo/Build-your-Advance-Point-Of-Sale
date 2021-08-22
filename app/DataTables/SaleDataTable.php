<?php

namespace App\DataTables;

use App\Sale;
use Yajra\DataTables\Services\DataTable;

class SaleDataTable extends DataTable
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
                function ($sale) {
                    return '<div title="' . __('View full and manage') . '">
           <a class="btn btn-sm" href="' . route('sale.show', $sale->id) . '">
          <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
           </a>
           </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Sale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sale $model)
    {
        return $model->newQuery()->select('*');
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
            'order_tax' => ['title' => __('Tax rate')],
            'tax_amount' => ['title' => __('Tax amount')],
            'discount_rate' => ['title' => __('Discount rate')],
            'discount_amount' => ['title' => __('Discount amount')],
            'enter_amount' => ['title' => __('Enter amount')],
            'payable' => ['title' => __('Payable')],
            'change' => ['title' => __('Change')],
            'total_price' => ['title' => __('Total price')],
            'total_items' => ['title' => __('Total items')],
            'biller_detail' => ['title' => __('Biller detail')],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sale_' . date('YmdHis');
    }
}
