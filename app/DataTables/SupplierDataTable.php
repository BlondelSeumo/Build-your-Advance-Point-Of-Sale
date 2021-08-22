<?php

namespace App\DataTables;

use App\Supplier;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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
                function ($supplier) {
                    return '<div title="' . __('View full and manage') . '">
           <a class="btn btn-sm" href="' . route('supplier.show', $supplier->id) . '">
            <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
           </a>
           </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
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
            'name' => ['title' => __('Name')],
            'email' => ['title' => __('Email')],
            'phone' => ['title' => __('Phone')],
            'company' => ['title' => __('Company')],
            'vat' => ['title' => __('Vat')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Supplier_' . date('YmdHis');
    }
}
