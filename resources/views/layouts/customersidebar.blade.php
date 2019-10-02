<nav class="col-lg-2 sidebar shadow navbar-laravel sidebar-nav" id="sidebarNav">
    <div class="sidebar-sticky" style="padding-top: 5.5rem;">
        <ul class="nav flex-column">
            <li >
                <a class="nav-link {{ Request::segment(1) == 'service-history' ? 'active' : '' }}" href="/service-history">{{ trans('messages.service_history') }}</a>
            </li>
            <li >
                <a class="nav-link {{ Request::segment(1) == 'invoice' ? 'active' : '' }}" href="/invoice">{{ trans('messages.invoice') }}</a>
            </li>
            <li >
                <a class="nav-link {{ Request::segment(1) == 'wallet' ? 'active' : '' }}" href="/wallet">{{ trans('messages.my_wallet') }}</a>
            </li>
            <li>
                <a class="nav-link {{ Request::segment(1) == 'tickets' ? 'active' : '' }}" href="/tickets">{{ trans('messages.tickets') }}</a>
            </li>
            <li >
                <a class="nav-link  {{ (Request::segment(1) == 'account' || Request::segment(1) == 'address') ? 'active' : '' }}" href="/account/profile/customer">{{ trans('messages.my_account') }}</a>
            </li>
            <!-- <li >
                <a class="nav-link {{ Request::segment(1) == 'account' ? 'active' : '' }}" href="/account">My account</a>
            </li>-->
        </ul>
    </div>
</nav>
