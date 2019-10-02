<nav class="col-md-2 sidebar shadow navbar-laravel sidebar-nav" id="sidebarNav">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) == 'service-history' ? 'active' : '' }}" href="/service-history">{{ trans('messages.service_history') }}</a>
            </li>
            <li >
                 <a class="nav-link {{ Request::segment(1) == 'tickets' ? 'active' : '' }}" href="/tickets">{{ trans('messages.tickets') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('expert/dashboard')) ? 'active' : '' }}" href="/expert/dashboard">{{ trans('messages.payout') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('expert/revenue')) ? 'active' : '' }}" href="/expert/revenue">{{ trans('messages.earnings') }}</a>
            </li>
            <li >
                <a class="nav-link  {{ (Request::segment(1) == 'account' || Request::segment(1) == 'address' || request()->is('user/upload-document') ) ? 'active' : '' }}" href="/account/profile/expert">{{ trans('messages.my_account') }}</a>
            </li>
            <!-- <li >
                <a class="nav-link {{ Request::segment(1) == 'invoice' ? 'active' : '' }}" href="/invoice">Invoice</a>
            </li> -->
        </ul>
    </div>
</nav>
