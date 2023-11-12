<ul class="nav nav-pills nav-sidebar flex-column custom-css-for-nav" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item item-dashboard">
        <a href="{{route('admin.dashboard')}}" class="nav-link {{isSidebarActive('admin.dashboard')}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                {{trans('customer.dashboard')}}
            </p>
        </a>
    </li>
    <li class="nav-item item-customers">
        <a href="{{route('admin.customers.index')}}" class="nav-link {{isSidebarActive('admin.customers*')}}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                {{trans('customer.customers')}}
            </p>
        </a>
    </li>
    <li class="nav-item item-plan">
        <a href="{{route('admin.plans.index')}}" class="nav-link {{isSidebarActive('admin.plans*')}}">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>
               {{trans('customer.plan')}} <span class="plan_pending_count">{{pendingPlanRequest()}}</span>
            </p>
        </a>
    </li>
    <li class="nav-item item-customers">
        <a href="{{route('admin.guest.user.massage')}}" class="nav-link {{isSidebarActive('admin.guest.user.massage*')}}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
                {{trans('admin.messages')}}
            </p>
        </a>
    </li>
    <li class="nav-item item-customers">
        <a href="{{route('admin.subscribe')}}" class="nav-link {{isSidebarActive('admin.subscribe*')}}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                {{trans('admin.subscribers')}}
            </p>
        </a>
    </li>

    <li class="nav-item item-ticket">
        <a href="{{route('admin.ticket.index')}}" class="nav-link {{isSidebarActive('admin.ticket*')}}">
            <i class="nav-icon fas fa-exclamation-triangle"></i>
            <p>
                {{trans('admin.ticket.ticket')}}
            </p>
        </a>
    </li>
   <li class="nav-item item-settings">
        <a href="{{route('admin.settings.index')}}" class="nav-link {{isSidebarActive('admin.settings*')}}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
                {{trans('customer.settings')}}
            </p>
        </a>
    </li>
    <li class="nav-item has-treeview {{isSidebarTrue(['admin.page*','admin.template*'])? 'menu-open' : ''}}">
        <a href="#" class="nav-link {{isSidebarTrue(['admin.page*','admin.template*'])? 'active' : ''}}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
                Website Settings
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: {{isSidebarTrue(['admin.template*','admin.page*'])? 'block': 'none'}};">
            <li class="nav-item">
                <a href="{{route('admin.template')}}" class="nav-link {{isSidebarActive('admin.template')}}">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>
                        {{trans('admin.template')}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.page.index')}}" class="nav-link {{isSidebarActive('admin.page*')}}">
                    <i class="nav-icon fas fa-file-powerpoint"></i>
                    <p>
                        {{trans('admin.page.page')}}
                    </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item item-addon d-none">
        <a href="{{route('admin.addon.index')}}" class="nav-link {{isSidebarActive('admin.addon*')}}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
                {{trans('admin.addon.addon')}}
            </p>
        </a>
    </li>
</ul>
