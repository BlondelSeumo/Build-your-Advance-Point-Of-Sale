<?php

namespace App\DataTables;

use App\Subcategory;
use Yajra\DataTables\Services\DataTable;

class SubcategoryDataTable extends DataTable
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
                function ($subcategory) {
                    return '<div title="' . __('View full and manage') . '">
           <a class="btn btn-sm" href="' . route('subcategory.show', $subcategory->id) . '">
           <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
           </a>
           </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Subcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subcategory $model)
    {
        return $model->newQuery()->select(['id', 'created_at', 'code', 'name', 'detail']);
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
            'code' => ['title' => __('Subcategory code')],
            'name' => ['title' => __('Subcategory name')],
            'detail' => ['title' => __('Subcategory detail')],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Subcategory_' . date('YmdHis');
    }
}
