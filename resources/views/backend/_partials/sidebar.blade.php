<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('assets/backend') }}/images/user.png" class="rounded-circle user-photo"
                alt="User Profile Picture" />
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name"
                    data-toggle="dropdown"><strong>{{ auth('admin')->user()->name }}</strong></a>
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
                        <x-backend.side-bar class="{{ request()->is('admin/dashboard') ? 'active' : ' ' }}"
                            name="Dashboard" link='backend.dashboard.index' icon='icon-home' />


                        {{-- Admin Panel --}}
                        <li class="{{ strpos($strpos, 'backend.admin') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Admin Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->segment(2) == 'admin' ? 'active' : ' ' }}"
                                    name="Admin" link='backend.admin.index' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'log-activity' ? 'active' : ' ' }}"
                                    name="Log-Activity" link='backend.admin.log.activity' icon='#' />
                            </ul>
                        </li>
                        {{-- End Admin Panel --}}

                        {{-- user Panel --}}
                        <li class="{{ strpos($strpos, 'backend.user') === 0 ? 'active' : ' ' }}">
                        <a href="javascript:void(0)" class="has-arrow">
                            <i class="icon-user-following"></i>
                            <span>Customer Panel</span>
                        </a>
                        <ul>
                            <x-backend.side-bar class="{{ request()->segment(2) == 'user' ? 'active' : ' ' }}" name="Customer" link='backend.user.index' icon='#' />
                        </ul>
                        </li>
                        {{-- End user Panel --}}

                        {{-- Account Panel --}}
                        <li class="{{ strpos($strpos, 'backend.account') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Accounting Panel</span>
                            </a>
                            <ul>
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'accountgroup' ? 'active' : ' ' }}"
                                    name="Account Group" link='backend.account.accountgroup.index' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'accountledger' ? 'active' : ' ' }}"
                                    name="Account Ledger" link='backend.account.accountledger.index'
                                    icon='#' />
                                {{-- <x-backend.side-bar class="{{ request()->segment(2) == 'transaction' ? 'active' : ' ' }}" name="Transaction" link='backend.account.transaction.index' icon='#' /> --}}
                            </ul>
                        </li>
                        {{-- End Admin Panel --}}
                        {{-- Report Panel --}}
                        <li class="{{ strpos($strpos, 'backend.report') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-user-following"></i>
                                <span>Report Panel</span>
                            </a>
                            <ul>
                                {{-- <x-backend.side-bar class="{{ request()->segment(2) == 'supplier-ledger' ? 'active' : ' ' }}" name="Supplier ledger" link='backend.report.supplierledgerReport' icon='#' /> --}}
                                <x-backend.side-bar class="{{ request()->segment(2) == 'day-book' ? 'active' : ' ' }}"
                                    name="Day book" link='backend.report.dayBook' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'cash-flow' ? 'active' : ' ' }}"
                                    name="Cash Flow" link='backend.report.cashFlow' icon='#' />
                                {{-- <x-backend.side-bar class="{{ request()->segment(2) == 'sell-report' ? 'active' : ' ' }}" name="Sell Report" link='backend.report.sellReport' icon='#' /> --}}
                                {{-- <x-backend.side-bar class="{{ request()->segment(2) == 'purchase-report' ? 'active' : ' ' }}" name="Purchase Report" link='backend.report.purchaseReport' icon='#' /> --}}
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'income-report' ? 'active' : ' ' }}"
                                    name="Income Report" link='backend.report.incomeReport' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'expense-report' ? 'active' : ' ' }}"
                                    name="Expence Report" link='backend.report.expenseReport' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(2) == 'profit-report' ? 'active' : ' ' }}"
                                    name="Profit Report" link='backend.report.profitReport' icon='#' />
                            </ul>
                        </li>
                        {{-- End Report Panel --}}

                        {{-- Site Configuration --}}
                        <li class="{{ strpos($strpos, 'backend.siteconfig') === 0 ? 'active' : ' ' }}">
                            <a href="javascript:void(0)" class="has-arrow">
                                <i class="icon-settings"></i>
                                <span>Site Configuration</span>
                            </a>
                            <ul>
                                <x-backend.side-bar class="{{ request()->is('admin/site-config' ? 'active' : ' ') }}"
                                    name="Site Info" link='backend.siteConfig.index' icon='#' />
                                {{--<x-backend.side-bar class="{{ request()->segment(3) == 'bed' ? 'active' : ' ' }}"
                                    name="Bed Config" link='backend.siteConfig.bed.index' icon='#' />
                                 <x-backend.side-bar class="{{ request()->segment(3) == 'symptom' ? 'active' : ' ' }}"
                                    name="Symptom Config" link='backend.siteConfig.symptom.index' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'serviceName' ? 'active' : ' ' }}"
                                    name="Service Config" link='backend.siteConfig.serviceName.index'
                                    icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'labTest' ? 'active' : ' ' }}"
                                    name="Lab Test Config" link='backend.siteConfig.labTest.index' icon='#' /> --}}
                                {{-- <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'bloodBank' ? 'active' : ' ' }}"
                                    name="Blood Config" link='backend.siteConfig.bloodBank.index' icon='#' /> --}}
                                <x-backend.side-bar class="{{ request()->segment(3) == 'slider' ? 'active' : ' ' }}"
                                    name="Slider" link='backend.siteConfig.slider.index' icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'banner' ? 'active' : ' ' }}"
                                    name="Banner" link='backend.siteConfig.banner.index' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'quick-page' ? 'active' : ' ' }}"
                                    name="Quick Page" link='backend.siteConfig.quick-page.index' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'email-configuration' ? 'active' : ' ' }}"
                                    name="Email Config" link='backend.siteConfig.email-configuration.index'
                                    icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'meta-tag' ? 'active' : ' ' }}"
                                    name="SEO Meta Config" link='backend.siteConfig.meta-tag.index' icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'socialmedia' ? 'active' : ' ' }}"
                                    name="Socail Media Config" link='backend.siteConfig.socialmedia.index'
                                    icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'barcode-method' ? 'active' : ' ' }}"
                                    name="Barcode Config" link='backend.siteConfig.barcode-method.index'
                                    icon='#' />
                                <x-backend.side-bar
                                    class="{{ request()->segment(3) == 'prefix-system' ? 'active' : ' ' }}"
                                    name="Invoice Prefix Config" link='backend.siteConfig.prefix-system.index'
                                    icon='#' />
                                <x-backend.side-bar class="{{ request()->segment(3) == 'tax-rate' ? 'active' : ' ' }}"
                                    name="Tax Config" link='backend.siteConfig.tax-rate.index' icon='#' />
                            </ul>
                        </li>
                        {{-- End Site Configuration --}}

                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
