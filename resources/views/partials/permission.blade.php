<div class="row">
    <div class="col-md-3">
        <table class="table table-striped">
            <caption>Entries Permission</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Group entries') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="product_add" name="product_add"
                                value="1" {{ $per->product_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="product_add">{{ __('Add new product') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category_add" name="category_add"
                                value="1" {{ $per->category_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="category_add">{{ __('New category') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="subcategory_add"
                                name="subcategory_add" value="1" {{ $per->subcategory_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="subcategory_add">{{ __('New subcategory') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="supplier_add" name="supplier_add"
                                value="1" {{ $per->supplier_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="supplier_add">{{ __('New supplier') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customer_add" name="customer_add"
                                value="1" {{ $per->customer_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="customer_add">{{ __('New customer') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="purchase_add" name="purchase_add"
                                value="1" {{ $per->purchase_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="purchase_add">{{ __('Make purchase') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="expense_add" name="expense_add"
                                value="1" {{ $per->expense_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="expense_add">{{ __('Add expense') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="warehouse_add" name="warehouse_add"
                                value="1" {{ $per->warehouse_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="warehouse_add">{{ __('New warehouse') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tax_add" name="tax_add" value="1"
                                {{ $per->tax_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="tax_add">{{ __('Define tax method') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="payment_add" name="payment_add"
                                value="1" {{ $per->payment_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="payment_add">{{ __('Add payment gateway') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <caption>Logs</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Log activity') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="logs_view" name="logs_view"
                                value="1" {{ $per->logs_view ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="logs_view">{{ __('View activity logs') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="logs_manage" name="logs_manage"
                                value="1" {{ $per->logs_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="logs_manage">{{ __('Manage activity logs') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-striped">
            <caption>Management Permission</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Management') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="product_manage"
                                name="product_manage" value="1" {{ $per->product_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="product_manage">{{ __('Manage products') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category_manage"
                                name="category_manage" value="1" {{ $per->category_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="category_manage">{{ __('Manage categories') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="subcategory_manage"
                                name="subcategory_manage" value="1" {{ $per->subcategory_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="subcategory_manage">{{ __('Manage subcategories') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="supplier_manage"
                                name="supplier_manage" value="1" {{ $per->supplier_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="supplier_manage">{{ __('Manage suppliers') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customer_manage"
                                name="customer_manage" value="1" {{ $per->customer_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="customer_manage">{{ __('Manage customers') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="purchase_manage"
                                name="purchase_manage" value="1" {{ $per->purchase_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="purchase_manage">{{ __('Manage purchase orders') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="expense_manage"
                                name="expense_manage" value="1" {{ $per->expense_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="expense_manage">{{ __('Manage expense vouchers') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="warehouse_manage"
                                name="warehouse_manage" value="1" {{ $per->warehouse_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="warehouse_manage">{{ __('Manage warehouses') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tax_manage" name="tax_manage"
                                value="1" {{ $per->tax_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="tax_manage">{{ __('Manage tax methods') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="payment_manage"
                                name="payment_manage" value="1" {{ $per->payment_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="payment_manage">{{ __('Manage payment gateways') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <caption>Finance Related Permissions</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Finance charts') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sale_summary" name="sale_summary"
                                value="1" {{ $per->sale_summary ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="sale_summary">{{ __('Sales charts') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="refund_summary"
                                name="refund_summary" value="1" {{ $per->refund_summary ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="refund_summary">{{ __('Refunds charts') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="expense_summary"
                                name="expense_summary" value="1" {{ $per->expense_summary ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="expense_summary">{{ __('Expenses charts') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="purchase_summary"
                                name="purchase_summary" value="1" {{ $per->purchase_summary ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="purchase_summary">{{ __('Purchases charts') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tax_summary" name="tax_summary"
                                value="1" {{ $per->tax_summary ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="tax_summary">{{ __('Taxes charts') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-striped">
            <caption>Setting Permissions</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('App settings') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_view" name="setting_view"
                                value="1" {{ $per->setting_view ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_view">{{ __('View master setting') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_general"
                                name="setting_general" value="1" {{ $per->setting_general ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_general">{{ __('Update general setting') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_logo" name="setting_logo"
                                value="1" {{ $per->setting_logo ? 'checked' : '' }}>
                            <label class="custom-control-label" for="setting_logo">{{ __('App logo') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_mail" name="setting_mail"
                                value="1" {{ $per->setting_mail ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_mail">{{ __('Mail configuration') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_product_default"
                                name="setting_product_default" value="1"
                                {{ $per->setting_product_default ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_product_default">{{ __('New product defaults') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_impects"
                                name="setting_impects" value="1" {{ $per->setting_impects ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_impects">{{ __('Set inventory impacts') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_pos" name="setting_pos"
                                value="1" {{ $per->setting_pos ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_pos">{{ __('POS configuration') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_quick_mail"
                                name="setting_quick_mail" value="1" {{ $per->setting_quick_mail ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_quick_mail">{{ __('Send quick mail') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <caption>Report Permissions</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Reports') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="product_inventory"
                                name="product_inventory" value="1" {{ $per->product_inventory ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="product_inventory">{{ __('Inventory alerts') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="purchase_report"
                                name="purchase_report" value="1" {{ $per->purchase_report ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="purchase_report">{{ __('Generate cost report') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sale_report" name="sale_report"
                                value="1" {{ $per->sale_report ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="sale_report">{{ __('Generate sale report') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tax_report" name="tax_report"
                                value="1" {{ $per->tax_report ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="tax_report">{{ __('Generate tax report') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="reports_save" name="reports_save"
                                value="1" {{ $per->reports_save ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="reports_save">{{ __('Can save report') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="reports_view" name="reports_view"
                                value="1" {{ $per->reports_view ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="reports_view">{{ __('Can view saved reports') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="reports_manage"
                                name="reports_manage" value="1" {{ $per->reports_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="reports_manage">{{ __('Manage saved report') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-striped">
            <caption>Chapter Permission</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Chapter register') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="chapter_open" name="chapter_open"
                                value="1" {{ $per->chapter_open ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="chapter_open">{{ __('Open register chapter') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="chapter_close" name="chapter_close"
                                value="1" {{ $per->chapter_close ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="chapter_close">{{ __('Close register chapter') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="chapter_manage"
                                name="chapter_manage" value="1" {{ $per->chapter_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="chapter_manage">{{ __('Manage register chapter') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <caption>POS Permissions</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Pos') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sale_create" name="sale_create"
                                value="1" {{ $per->sale_create ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="sale_create">{{ __('Can sale item') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="refund_create" name="refund_create"
                                value="1" {{ $per->refund_create ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="refund_create">{{ __('Can refund') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sale_manage" name="sale_manage"
                                value="1" {{ $per->sale_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="sale_manage">{{ __('Manage sale orders') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="refund_manage" name="refund_manage"
                                value="1" {{ $per->refund_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="refund_manage">{{ __('Manage refund orders') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <caption>User Permission</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">Users</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user_create" name="user_create"
                                value="1" {{ $per->user_create ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="user_create">{{ __('Create new user') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user_manage" name="user_manage"
                                value="1" {{ $per->user_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="user_manage">{{ __('User management') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user_edit" name="user_edit"
                                value="1" {{ $per->user_edit ? 'checked' : '' }}>
                            <label class="custom-control-label" for="user_edit">{{ __('User edit') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="group_add" name="group_add"
                                value="1" {{ $per->group_add ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="group_add">{{ __('Add permission group') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="group_manage" name="group_manage"
                                value="1" {{ $per->group_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="group_manage">{{ __('Manage permission group') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="group_request" name="group_request"
                                value="1" {{ $per->group_request ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="group_request">{{ __('Can request dedicated permission group') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="group_request_manage"
                                name="group_request_manage" value="1"
                                {{ $per->group_request_manage ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="group_request_manage">{{ __('Manage dedicated permissions requests') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <caption>Miscellaneous Permissions</caption>
            <thead class="bg-warning">
                <tr>
                    <th scope="row" class="th-with-50">{{ __('Miscellaneous') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_dashboard"
                                name="setting_dashboard" value="1" {{ $per->setting_dashboard ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_dashboard">{{ __('Dashboard') }}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setting_backup"
                                name="setting_backup" value="1" {{ $per->setting_backup ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="setting_backup">{{ __('Database backup') }}</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
