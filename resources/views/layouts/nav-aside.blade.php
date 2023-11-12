<!-- SIDE MENU BAR -->
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{url('/')}}">
            <img src="{{URL::asset('img/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Admintro logo" style="width:80px;margin-left:-50px">
            <img src="{{URL::asset('img/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Admintro logo">
        </a>
    </div>
    <ul class="side-menu app-sidebar3">
        <li class="side-item side-item-category mt-4 mb-3">{{ __('AI Panel') }}</li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard')}}">
            <span class="side-menu__icon lead-3 fa-solid fa-chart-tree-map"></span>
            <span class="side-menu__label">Dashboard</span></a>
        </li>



        <li class="slide">
            <a class="side-menu__item" href="{{route('product.index')}}">
            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-location-dot"></span>
            <span class="side-menu__label">Product</span></a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('comment.index')}}">
            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-location-dot"></span>
            <span class="side-menu__label">Comments</span></a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('feedback.index')}}">
            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-location-dot"></span>
            <span class="side-menu__label">Feedbacks</span></a>
        </li>


        <li class="slide">
            <a class="side-menu__item" href="{{route('user.index')}}">
            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-users-viewfinder"></span>
            <span class="side-menu__label">Users</span></a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('roles.index')}}">
            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-people-roof"></span>
            <span class="side-menu__label">Roles</span></a>
        </li>



    </ul>
</aside>
<!-- END SIDE MENU BAR -->
