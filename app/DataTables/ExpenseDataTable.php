<?php

namespace App\DataTables;

use App\Expense;
use Yajra\DataTables\Services\DataTable;

class ExpenseDataTable extends DataTable
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
                function ($expense) {
                    return '<div title="' . __('View full and manage') . '">
                                <a class="btn" href="' . route('expense.show', $expense->id) . '">
                                        <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
                                </a>
                            </div>';
                }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Expense $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
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
            'amount' => ['title' => __('Amount')],
            'note' => ['title' => __('Expense note')],
            'by' => ['title' => __('By')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Expense_' . date('YmdHis');
    }
}
