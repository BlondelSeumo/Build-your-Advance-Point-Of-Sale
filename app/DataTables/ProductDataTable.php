<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                function ($product) {
                    return '<div title="' . __('View full and manage') . '">
                                <a class="btn btn-sm" href="' . route('product.show', $product->id) . '">
                                          <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
                                </a>
                            </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            'name' => ['title' => __('Product name')],
            'code' => ['title' => __('Product code')],
            'cost' => ['title' => __('Product cost')],
            'price' => ['title' => __('Product price')],
            'qty' => ['title' => __('Product qty')],
            'alert_quantity' => ['title' => __('Product alert qty')],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
