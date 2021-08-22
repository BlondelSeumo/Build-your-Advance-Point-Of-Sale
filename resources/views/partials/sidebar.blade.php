<div class="sidebar">
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user p-0">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info" data-toggle="tooltip" title="{{ __('Click to edit your information') }}">
                    <a href="{{ route('user.edit', Auth::user()) }}" class="btn-sm">
                        <span class="m-0 p-0">
                            <strong>{{ Auth::user()->name }} </strong>
                            <span class="user-level m-0">{{ Auth::user()->group->name }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Home and quick mailing service') }}">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-fw text-info fa-home" aria-hidden="true"></i>
                        <p>{{ __('Home') }}</p>
                    </a>
                </li>
                @can('dashboard', 'App\Setting')
                    <li class="nav-item" data-toggle="tooltip" title="{{ __('Dashboard last 10 orders quick links') }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-fw text-info fa-tachometer-alt" aria-hidden="true"></i>
                            <p>{{ __('Dashboard') }}</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item" data-toggle="tooltip" title="{{ __('POS') }}">
                    <a data-toggle="collapse" href="#pos">
                        <i class="fas fa-fw text-info fa-shopping-cart" aria-hidden="true"></i>
                        <p>{{ __('Pos') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="pos">
                        <ul class="nav nav-collapse">
                            <li data-toggle="tooltip" title="{{ __('Go to point of sale portal') }}">
                                <a href="{{ route('pos.index') }}" data-toggle="tooltip"
                                    title="{{ __('Switch to POS') }}">
                                    <span class="sub-item">{{ __('Switch to POS') }}</span>
                                </a>
                            </li>
                            @can('open', 'App\Chapter')
                                <li data-toggle="tooltip" title="{{ __('Open new register cash in hands') }}">
                                    <a href="{{ route('chapter.create') }}" data-toggle="tooltip"
                                        title="{{ __('Open new sale register') }}">
                                        <span class="sub-item">{{ __('New register') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Chapter')
                                <li data-toggle="tooltip" title="{{ __('Chapter tile') }}">
                                    <a href="{{ route('chapter.index') }}">
                                        <span class="sub-item">{{ __('Registers') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Sale')
                                <li data-toggle="tooltip" title="{{ __('Sale orders management') }}">
                                    <a href="{{ route('sale.index') }}">
                                        <span class="sub-item">{{ __('Manage sales') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Refund')
                                <li data-toggle="tooltip" title="{{ __('Refund orders management') }}">
                                    <a href="{{ route('refund.index') }}">
                                        <span class="sub-item">{{ __('Manage refunds') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Products') }}">
                    <a data-toggle="collapse" href="#products">
                        <i class="fas fa-fw text-info fa-cubes" aria-hidden="true"></i>
                        <p>{{ __('Products') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="products">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Product')
                                <li>
                                    <a href="{{ route('product.create') }}" data-toggle="tooltip"
                                        title="{{ __('Add new product') }}">
                                        <span class="sub-item">{{ __('Add product') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Product')
                                <li>
                                    <a href="{{ route('product.index') }}" data-toggle="tooltip"
                                        title="{{ __('Products management') }}">
                                        <span class="sub-item">{{ __('Products list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Categories') }}">
                    <a data-toggle="collapse" href="#category">
                        <i class="fas fa-fw text-info fa-sitemap" aria-hidden="true"></i>
                        <p>{{ __('Categories') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Category')
                                <li>
                                    <a href="{{ route('category.create') }}" data-toggle="tooltip"
                                        title="{{ __('Category for products') }}">
                                        <span class="sub-item">{{ __('Create category') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Category')
                                <li>
                                    <a href="{{ route('category.index') }}" data-toggle="tooltip"
                                        title="{{ __('Categories management') }}">
                                        <span class="sub-item">{{ __('Categories list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Subcategories') }}">
                    <a data-toggle="collapse" href="#subcategory">
                        <i class="fas fa-fw text-info fa-sitemap" aria-hidden="true"></i>
                        <p>{{ __('Subcategories') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="subcategory">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Subcategory')
                                <li>
                                    <a href="{{ route('subcategory.create') }}" data-toggle="tooltip"
                                        title="{{ __('Subcategory for products') }}">
                                        <span class="sub-item">{{ __('Create subcategory') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Subcategory')
                                <li>
                                    <a href="{{ route('subcategory.index') }}" data-toggle="tooltip"
                                        title="{{ __('Subcategories management') }}">
                                        <span class="sub-item">{{ __('Subcategories list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Suppliers') }}">
                    <a data-toggle="collapse" href="#suppliers">
                        <i class="fas fa-fw text-info fa-user-plus" aria-hidden="true"></i>
                        <p>{{ __('Suppliers') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="suppliers">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Supplier')
                                <li>
                                    <a href="{{ route('supplier.create') }}" data-toggle="tooltip"
                                        title="{{ __('Add new supplier') }}">
                                        <span class="sub-item">{{ __('Add supplier') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Supplier')
                                <li>
                                    <a href="{{ route('supplier.index') }}" data-toggle="tooltip"
                                        title="{{ __('Suppliers management') }}">
                                        <span class="sub-item">{{ __('Suppliers list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Expenses') }}">
                    <a data-toggle="collapse" href="#expenses">
                        <i class="fas fa-fw text-info fa-minus-circle" aria-hidden="true"></i>
                        <p>{{ __('Expenses') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="expenses">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Expense')
                                <li>
                                    <a href="{{ route('expense.create') }}" data-toggle="tooltip"
                                        title="{{ __('Add expense voucher') }}">
                                        <span class="sub-item">{{ __('Expense voucher') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Expense')
                                <li>
                                    <a href="{{ route('expense.index') }}" data-toggle="tooltip"
                                        title="{{ __('Expenses management') }}">
                                        <span class="sub-item">{{ __('Expenses list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Suppliers') }}">
                    <a data-toggle="collapse" href="#customers">
                        <i class="fas fa-fw text-info fa-user" aria-hidden="true"></i>
                        <p>{{ __('Customers') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="customers">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Customer')
                                <li>
                                    <a href="{{ route('customer.create') }}" data-toggle="tooltip"
                                        title="{{ __('Add new customer') }}">
                                        <span class="sub-item">{{ __('Add customer') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Customer')
                                <li>
                                    <a href="{{ route('customer.index') }}" data-toggle="tooltip"
                                        title="{{ __('Customers management') }}">
                                        <span class="sub-item">{{ __('Customers list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Payments') }}">
                    <a data-toggle="collapse" href="#payments">
                        <i class="fas fa-fw text-info fa-money-bill" aria-hidden="true"></i>
                        <p>{{ __('Payments') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="payments">
                        <ul class="nav nav-collapse" id="entries">
                            @can('create', 'App\Payment')
                                <li>
                                    <a href="{{ route('payment.create') }}" data-toggle="tooltip"
                                        title="{{ __('Define payment gateway') }}">
                                        <span class="sub-item">{{ __('New payment gateway') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Payment')
                                <li>
                                    <a href="{{ route('payment.index') }}" data-toggle="tooltip"
                                        title="{{ __('Payments management') }}">
                                        <span class="sub-item">{{ __('Payments') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Warehouses') }}">
                    <a data-toggle="collapse" href="#warehouses">
                        <i class="fas fa-fw text-info fa-warehouse" aria-hidden="true"></i>
                        <p>{{ __('Warehouses') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="warehouses">
                        <ul class="nav nav-collapse" id="warehouses">
                            @can('create', 'App\Warehouse')
                                <li>
                                    <a href="{{ route('warehouse.create') }}" data-toggle="tooltip"
                                        title="{{ __('Register new warehouse') }}">
                                        <span class="sub-item">{{ __('Register warehouse') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Warehouse')
                                <li>
                                    <a href="{{ route('warehouse.index') }}" data-toggle="tooltip"
                                        title="{{ __('Warehouses management') }}">
                                        <span class="sub-item">{{ __('Warehouses list') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Purchases') }}">
                    <a data-toggle="collapse" href="#purchases">
                        <i class="fas fa-fw text-info fa-th-large" aria-hidden="true"></i>
                        <p>{{ __('Purchases') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="purchases">
                        <ul class="nav nav-collapse" id="purchases">
                            @can('create', 'App\Purchase')
                                <li>
                                    <a href="{{ route('purchase.create') }}" data-toggle="tooltip"
                                        title="{{ __('Make purchase') }}">
                                        <span class="sub-item">{{ __('Make purchase') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Purchase')
                                <li>
                                    <a href="{{ route('purchase.index') }}" data-toggle="tooltip"
                                        title="{{ __('Purchases management') }}">
                                        <span class="sub-item">{{ __('Purchase orders') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Taxes') }}">
                    <a data-toggle="collapse" href="#taxes">
                        <i class="fas fa-fw text-info fa-percent" aria-hidden="true"></i>
                        <p>{{ __('Taxes') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="taxes">
                        <ul class="nav nav-collapse" id="taxes">
                            @can('create', 'App\Tax')
                                <li>
                                    <a href="{{ route('tax.create') }}" data-toggle="tooltip"
                                        title="{{ __('Define new tax') }}">
                                        <span class="sub-item">{{ __('Define tax') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Tax')
                                <li>
                                    <a href="{{ route('tax.index') }}" data-toggle="tooltip"
                                        title="{{ __('Taxes management') }}">
                                        <span class="sub-item">{{ __('Taxes') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Resource charts') }}">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-fw text-info fa-money-check-alt" aria-hidden="true"></i>
                        <p>{{ __('Finance charts') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse" id="finance">
                            @can('summary', 'App\Sale')
                                <li data-toggle="tooltip" title="{{ __('Annual sale chart') }}">
                                    <a href="{{ route('sale.detail') }}">
                                        <span class="sub-item">{{ __('Annual sale chart') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('summary', 'App\Refund')
                                <li data-toggle="tooltip" title="{{ __('Annual refund chart') }}">
                                    <a href="{{ route('refund.detail') }}">
                                        <span class="sub-item">{{ __('Annual refund chart') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('summary', 'App\Expense')
                                <li data-toggle="tooltip" title="{{ __('Annual expense chart') }}">
                                    <a href="{{ route('expense.detail') }}">
                                        <span class="sub-item">{{ __('Annual expense chart') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('summary', 'App\Purchase')
                                <li data-toggle="tooltip" title="{{ __('Annual purchase chart') }}">
                                    <a href="{{ route('purchase.detail') }}">
                                        <span class="sub-item">{{ __('Annual purchase chart') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('summary', 'App\Tax')
                                <li data-toggle="tooltip" title="{{ __('Annual taxes chart') }}">
                                    <a href="{{ route('tax.detail') }}">
                                        <span class="sub-item">{{ __('Annual taxes chart') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Daily monthly period reports') }}">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-fw text-info fa-file-alt" aria-hidden="true"></i>
                        <p>{{ __('Reports') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse" id="reports">
                            @can('report', 'App\Product')
                                <li data-toggle="tooltip"
                                    title="{{ __('Out of stock products with low quantity impacts') }}">
                                    <a href="{{ route('product.inventory') }}">
                                        <span class="sub-item">{{ __('Inventory alerts') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('report', 'App\Purchase')
                                <li data-toggle="tooltip" title="{{ __('Cost report title') }}">
                                    <a href="{{ route('cost.report') }}">
                                        <span class="sub-item">{{ __('Cost report') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('report', 'App\Sale')
                                <li data-toggle="tooltip" title="{{ __('Sale report title') }}">
                                    <a href="{{ route('sale.report') }}">
                                        <span class="sub-item"> {{ __('Sale report') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('report', 'App\Tax')
                                <li data-toggle="tooltip" title="{{ __('Tax report title') }}">
                                    <a href="{{ route('tax.report') }}">
                                        <span class="sub-item"> {{ __('Tax report') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view', 'App\Report')
                                <li data-toggle="tooltip" title="{{ __('Saved report title') }}">
                                    <a href="{{ route('report.index') }}">
                                        <span class="sub-item">{{ __('Saved reports') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @can('backup', 'App\Setting')
                    <li class="nav-item" data-toggle="tooltip" title="{{ __('Backup title') }}">
                        <a href="{{ route('backup.index') }}">
                            <i class="fas fa-fw text-info fa-database" aria-hidden="true"></i>
                            <p>{{ __('Backup') }}</p>
                        </a>
                    </li>
                @endcan
                @can('view', 'App\UserActivity')
                    <li class="nav-item" data-toggle="tooltip" title="{{ __('Log activity title') }}">
                        <a href="{{ route('logs.index') }}">
                            <i class="fa fa-history fa-fw text-info" aria-hidden="true"></i>
                            <p>{{ __('Activity logs') }}</p>
                        </a>
                    </li>
                @endcan
                @can('view', 'App\Setting')
                    <li class="nav-item" data-toggle="tooltip" title="{{ __('Master configuration') }}">
                        <a href="{{ route('setting.index') }}">
                            <i class="fas fa-fw text-info fa-cogs" aria-hidden="true"></i>
                            <p> {{ __('Settings') }}</p>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" title="{{ __('Translations') }}">
                        <a href="{{ route('language.index') }}">
                            <i class="fas fa-fw text-info fa-star" aria-hidden="true"></i>
                            <p> {{ __('Translations') }}</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item" data-toggle="tooltip" title="{{ __('User manage title') }}">
                    <a data-toggle="collapse" href="#custompages">
                        <i class="fas fa-fw text-info fa-users" aria-hidden="true"></i>
                        <p>{{ __('User controls') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="custompages">
                        <ul class="nav nav-collapse" id="users">
                            @can('create', 'App\User')
                                <li data-toggle="tooltip" title="{{ __('Add new user') }}">
                                    <a href="{{ route('register') }}">
                                        <span class="sub-item"> {{ __('Add user') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\User')
                                <li data-toggle="tooltip" title="{{ __('Manage users title') }}">
                                    <a href="{{ route('user.index') }}">
                                        <span class="sub-item"> {{ __('Manage users') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('create', 'App\Group')
                                <li data-toggle="tooltip" title="{{ __('Perm add title') }}">
                                    <a href="{{ route('group.create') }}">
                                        <span class="sub-item">{{ __('New group') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage', 'App\Group')
                                <li data-toggle="tooltip" title="{{ __('Manage group title') }}">
                                    <a href="{{ route('group.index') }}">
                                        <span class="sub-item">{{ __('Manage group') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manageRequest', 'App\Group')
                                <li data-toggle="tooltip" title="{{ __('Perm request title') }}">
                                    <a href="{{ route('group.requests') }}">
                                        <span class="sub-item"> {{ __('Permission requests') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" title="{{ __('Logout') }}">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-fw text-info fa-sign-out-alt" aria-hidden="true"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
