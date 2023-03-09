<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('assets/backend') }}/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture" />
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{
                        auth('admin')->user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li>
                        <a href="#"><i class="icon-user"></i>Profile</a>
                    </li>

                </ul>
            </div>
        </div>

        @php
        $strpos = Route::currentRouteName();
        @endphp

        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">

                    <ul id="main-menu" class="metismenu">
                        <x-backend.side-bar class="{{ request()->is('admin/dashboard') ? 'active' : ' ' }}" name="Dashboard" link='backend.dashboard.index' icon='icon-home' />


                        {{-- order Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.order') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Order Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'order-list-pending' ? 'active' : ' ' }}" name="Pending" link='backend.order.order-list-pending.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'order-list-processing' ? 'active' : ' ' }}" name="Processing" link='backend.order.order-list-processing.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'order-list-delivered' ? 'active' : ' ' }}" name="Delivered" link='backend.order.order-list-delivered.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'order-list' ? 'active' : ' ' }}" name="Paid" link='backend.order.order-list.index' icon='#' />

                        </ul>
                        </li> --}}
                        {{-- End order Panel --}}


                        {{-- purchase Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.purchase') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Purchase Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->is('admin/purchase') ? 'active' : ' ' }}" name="List" link='backend.purchase.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->is('admin/purchase/create') ? 'active' : ' ' }}" name="Create" link='backend.purchase.create' icon='#' />

                        </ul>
                        </li> --}}
                        {{-- End purchase Panel --}}

                        {{-- Pos Panel --}}
                        {{-- <li
                            class="{{ strpos($strpos, 'backend.outlet') === 0 ? 'active' : ' ' }}{{ strpos($strpos, 'backend.register') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Pos Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'admin' ? 'active' : ' ' }}" name="Create" link='backend.pos.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'outlet' ? 'active' : ' ' }}" name="Outlet" link='backend.outlet.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'register' ? 'active' : ' ' }}" name="Register" link='backend.register.index' icon='#' />
                        </ul>
                        </li> --}}
                        {{-- End Pos Panel --}}

                        {{-- production Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.production') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Production Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'production' ? 'active' : ' ' }}" name="production" link='backend.production.index' icon='#' />

                        </ul>
                        </li> --}}
                        {{-- End production Panel --}}

                        {{-- Inventory Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.inventory') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Inventory Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'invetory' ? 'active' : ' ' }}" name="Invetory" link='backend.inventory.inventoryitem.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'warehouse' ? 'active' : ' ' }}" name="Warehouse" link='backend.inventory.warehouse.index' icon='#' />

                        </ul>
                        </li> --}}
                        {{-- End Inventory Panel --}}

                        {{-- appointment Panel --}}
                        <li class="{{ strpos($strpos, 'backend.appointment') === 0 ? 'active' : ' ' }} {{ strpos($strpos, 'backend.dialysis-appointment') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Appointment Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->segment(2) == 'appointment' ? 'active' : ' ' }}" name="Doctor Appoint." link='backend.appointment.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(2) == 'dialysis-appointment' ? 'active' : ' ' }}" name="Dailyses Appoint." link='backend.dialysis-appointment.index' icon='#' />

                            </ul>
                        </li>
                        {{-- End appointment Panel --}}

                        {{-- prescription Panel --}}
                        <li class="{{ strpos($strpos, 'backend.prescription') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Prescription Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->segment(2) == 'prescription' ? 'active' : ' ' }}" name="Prescription" link='backend.prescription.index' icon='#' />

                            </ul>
                        </li>
                        {{-- End prescription Panel --}}

                        {{-- patient Panel --}}
                        <li class="{{ strpos($strpos, 'backend.patient') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Patient Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->segment(2) == 'patient' ? 'active' : ' ' }}" name="Patient" link='backend.patient.index' icon='#' />

                            </ul>
                        </li>
                        {{-- End patient Panel --}}

                        {{-- Doctor Panel --}}
                        <li class="{{ strpos($strpos, 'backend.doctor') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Doctor Panel</span>
                            </a>
                            <ul>

                                <x-backend.side-bar class="{{ request()->segment(2) == 'doctor' ? 'active' : ' ' }}" name="Doctor" link='backend.doctor.index' icon='#' />

                            </ul>
                        </li>
                        {{-- End Doctor Panel --}}
                        {{-- Employee Panel --}}
                        <li class="{{ strpos($strpos, 'backend.employee') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Employee Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->segment(2) == 'employee' ? 'active' : ' ' }}" name="Employee" link='backend.employee.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(2) == 'designation' ? 'active' : ' ' }}" name="Designation" link='backend.employee.designation.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(2) == 'department' ? 'active' : ' ' }}" name="Department" link='backend.employee.department.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(2) == 'shift' ? 'active' : ' ' }}" name="Shift" link='backend.employee.shift.index' icon='#' />
                            </ul>
                        </li>
                        {{-- End Employee Panel --}}

                        {{-- supplier Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.supplier') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Supplier Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'supplier' ? 'active' : ' ' }}" name="Supplier" link='backend.supplier.index' icon='#' />

                        </ul>
                        </li> --}}
                        {{-- End supplier Panel --}}

                        {{-- Admin Panel --}}
                        <li class="{{ strpos($strpos, 'backend.admin') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Admin Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->segment(2) == 'admin' ? 'active' : ' ' }}" name="Admin" link='backend.admin.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(2) == 'log-activity' ? 'active' : ' ' }}" name="Log-Activity" link='backend.admin.log.activity' icon='#' />
                            </ul>
                        </li>
                        {{-- End Admin Panel --}}

                        {{-- user Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.user') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Customer Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'user' ? 'active' : ' ' }}" name="Customer" link='backend.user.index' icon='#' />
                        </ul>
                        </li> --}}
                        {{-- End user Panel --}}
                        {{-- Item Config --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.itemconfig') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-settings"></i>
                            <span>Item Config</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(3) == 'item' ? 'active' : ' ' }}" name="Item" link='backend.itemconfig.item.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'category' ? 'active' : ' ' }}" name="Category" link='backend.itemconfig.category.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'subcategory' ? 'active' : ' ' }}" name="Subcategory" link='backend.itemconfig.subcategory.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'childcategory' ? 'active' : ' ' }}" name="Childcategory" link='backend.itemconfig.childcategory.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'brand' ? 'active' : ' ' }}" name="Brand" link='backend.itemconfig.brand.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'unit' ? 'active' : ' ' }}" name="Unit" link='backend.itemconfig.unit.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'strenght' ? 'active' : ' ' }}" name="Strenght" link='backend.itemconfig.strenght.index' icon='#' />

                            <x-backend.side-bar class="{{ request()->segment(3) == 'rack' ? 'active' : ' ' }}" name="Rack" link='backend.itemconfig.rack.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(3) == 'row' ? 'active' : ' ' }}" name="Row" link='backend.itemconfig.row.index' icon='#' />
                        </ul>
                        </li> --}}
                        {{-- End Item Config --}}
                        {{-- Account Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.account') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Accounting Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'accountgroup' ? 'active' : ' ' }}" name="Account Group" link='backend.account.accountgroup.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'accountledger' ? 'active' : ' ' }}" name="Account Ledger" link='backend.account.accountledger.index' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'transaction' ? 'active' : ' ' }}" name="Transaction" link='backend.account.transaction.index' icon='#' />
                        </ul>
                        </li> --}}
                        {{-- End Admin Panel --}}
                        {{-- Report Panel --}}
                        {{-- <li class="{{ strpos($strpos, 'backend.report') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Report Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'supplier-ledger' ? 'active' : ' ' }}" name="Supplier ledger" link='backend.report.supplierledgerReport' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'day-book' ? 'active' : ' ' }}" name="Day book" link='backend.report.dayBook' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'cash-flow' ? 'active' : ' ' }}" name="Cash Flow" link='backend.report.cashFlow' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'sell-report' ? 'active' : ' ' }}" name="Sell Report" link='backend.report.sellReport' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'purchase-report' ? 'active' : ' ' }}" name="Purchase Report" link='backend.report.purchaseReport' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'income-report' ? 'active' : ' ' }}" name="Income Report" link='backend.report.incomeReport' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'expense-report' ? 'active' : ' ' }}" name="Expence Report" link='backend.report.expenseReport' icon='#' />
                            <x-backend.side-bar class="{{ request()->segment(2) == 'profit-report' ? 'active' : ' ' }}" name="Profit Report" link='backend.report.profitReport' icon='#' />
                        </ul>
                        </li> --}}
                        {{-- End Report Panel --}}

                        {{-- Site Configuration --}}
                        <li class="{{ strpos($strpos, 'backend.siteconfig') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-settings"></i>
                                <span>Site Configuration</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->is('admin/site-config' ? 'active' : ' ') }}" name="Site Info" link='backend.siteconfig.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'bed' ? 'active' : ' ' }}" name="Bed Config" link='backend.siteconfig.bed.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'symptom' ? 'active' : ' ' }}" name="Symptom Config" link='backend.siteconfig.symptom.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'serviceName' ? 'active' : ' ' }}" name="Service Config" link='backend.siteconfig.serviceName.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'bloodBank' ? 'active' : ' ' }}" name="Blood Config" link='backend.siteconfig.bloodBank.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'slider' ? 'active' : ' ' }}" name="Slider" link='backend.siteconfig.slider.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'banner' ? 'active' : ' ' }}" name="Banner" link='backend.siteconfig.banner.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'quick-page' ? 'active' : ' ' }}" name="Quick Page" link='backend.siteconfig.quick-page.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'email-configuration' ? 'active' : ' ' }}" name="Email Config" link='backend.siteconfig.email-configuration.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'meta-tag' ? 'active' : ' ' }}" name="SEO Meta Config" link='backend.siteconfig.meta-tag.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'socialmedia' ? 'active' : ' ' }}" name="Socail Media Config" link='backend.siteconfig.socialmedia.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'barcode-method' ? 'active' : ' ' }}" name="Barcode Config" link='backend.siteconfig.barcode-method.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'prefix-system' ? 'active' : ' ' }}" name="Invoice Prefix Config" link='backend.siteconfig.prefix-system.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'tax-rate' ? 'active' : ' ' }}" name="Taxt Config" link='backend.siteconfig.tax-rate.index' icon='#' />
                            </ul>
                        </li>
                        {{-- End Site Configuration --}}

                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
