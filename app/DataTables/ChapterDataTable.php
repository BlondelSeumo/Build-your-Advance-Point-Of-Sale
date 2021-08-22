<?php

namespace App\DataTables;

use App\Chapter;
use Yajra\DataTables\Services\DataTable;

class ChapterDataTable extends DataTable
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
                function ($chapter) {
                    return '<div title="' . __('View full and manage') . '">
           <a class="btn btn-sm" href="' . route('chapter.show', $chapter->id) . '">
           <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
           </a>
           </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Chapter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Chapter $model)
    {
        return $model->newQuery()->select(
            ['*']
        );
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
            'key' => ['title' => __('Key')],
            'sale_orders' => ['title' => __('Sale orders')],
            'tax_amount' => ['title' => __('Tax amount')],
            'refund_orders' => ['title' => __('Refund orders')],
            'low_price_index' => ['title' => __('Low price index')],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Chapter_' . date('YmdHis');
    }
}
