<!-- SIDE MENU BAR -->
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{url('/')}}">
            <img src="{{URL::asset('img/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Admintro logo">
            <img src="{{URL::asset('img/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Admintro logo">
        </a>
    </div>
    <ul class="side-menu app-sidebar3">
        <li class="side-item side-item-category mt-4 mb-3">{{ __('AI Panel') }}</li>
       
        @can('manage_compose')

        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.smsbox.compose')}}">
                <span class="side-menu__icon lead-3 fas fa-plus-circle"></span>
                <span class="side-menu__label"> {{trans('customer.quick_send')}}</span></a>
        </li>
      
        @endcan

        @can('manage_dashboard')
        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.dashboard')}}">
                <span class="side-menu__icon lead-3 fa-solid fa-chart-tree-map"></span>
                <span class="side-menu__label">{{trans('customer.dashboard')}}</span></a>
        </li>
        @endcan

        @can('manage_compose')
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('#')}}">
                <span class="side-menu__icon fa-solid fa-comment-dots"></span>
                <span class="side-menu__label">{{trans('customer.messages')}}</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li ><a href="{{route('customer.smsbox.overview')}}" class="slide-item">  {{trans('customer.overview')}}</a></li>
                    <li><a href="{{route('customer.smsbox.overview',['type'=>'inbox'])}}" class="slide-item">{{trans('customer.inbound')}}</a></li>  
                    <li><a href="{{route('customer.smsbox.overview',['type'=>'sent'])}}" class="slide-item"> {{trans('customer.outbound')}}</a></li>                    
                    <li><a href="{{route('customer.settings.index',['type'=>'sending_settings'])}}" class="slide-item">{{trans('Sending Setting')}}</a></li>                    

                </ul>
        </li>
        @endcan

        @can('manage_campaign')
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('#')}}">
                <span class="side-menu__icon fas fa-campground"></span>
                <span class="side-menu__label">{{trans('customer.campaigns')}}</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li ><a href="{{route('customer.campaign.create')}}" class="slide-item">  {{trans('customer.create')}}</a></li>
                    <li><a href="{{route('customer.campaign.index')}}" class="slide-item">{{trans('customer.list')}}</a></li>  
                    <li><a href="{{route('customer.settings.index',['type'=>'settings'])}}" class="slide-item">{{trans('customer.template')}}</a></li>                    
                </ul>
        </li>
        @endcan

        @can('manage_contacts')
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('#')}}">
                <span class="side-menu__icon fas fa-phone-alt"></span>
                <span class="side-menu__label">{{trans('customer.contacts')}}</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li ><a href="{{route('customer.contacts.index')}}" class="slide-item">  {{trans('customer.list')}}</a></li>
                    <li><a href="{{route('customer.groups.index')}}" class="slide-item"> {{trans('customer.groups')}}</a></li>  
                    <li><a href="{{route('customer.group.records')}}" class="slide-item">{{trans('customer.builder')}}</a></li>   
                    <li><a href="{{route('customer.label.index')}}" class="slide-item">{{trans('customer.labels')}}</a></li>                    
                </ul>
        </li>
        @endcan



        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('#')}}">
                <span class="side-menu__icon fas fa-mobile"></span>
                <span class="side-menu__label"> {{trans('customer.devices')}}</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                @can('device_add')
                    <li ><a href="{{route('customer.device.index',['type'=>'add'])}}" class="slide-item">  {{trans('customer.add')}}</a></li>
                @endcan
                @can('device_list')
                <li ><a href="{{route('customer.device.index')}}" class="slide-item">  {{trans('customer.list')}}</a></li>
                @endcan
                @if(get_settings('link_apk'))
                <li ><a href="#" class="slide-item" download_apk="{{get_settings('link_apk')}}" id="download_apk">   {{trans('customer.download_apk')}}</a></li>
                @endif
                </ul>
        </li>
               
     

        @can('manage_chatbox')

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('#')}}">
                <span class="side-menu__icon fas fa-sms"></span>
                <span class="side-menu__label"> {{trans('customer.chat_box')}}</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li ><a href="{{route('customer.chat.index')}}" class="slide-item">  {{trans('customer.chat')}}</a></li>
                    <li ><a href="{{route('customer.chat.response')}}" class="slide-item">   {{trans('customer.chat_responses')}}</a></li>
                </ul>
        </li>

        @endcan

        @can('manage_billing')
        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.billing.index')}}">
                <span class="side-menu__icon lead-3 fas fa-file-invoice-dollar"></span>
                <span class="side-menu__label">{{trans('customer.billing')}}</span></a>
        </li>
        @endcan

        @can('manage_developer')

        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.authorization.token.create')}}">
                <span class="side-menu__icon lead-3 fas fa-code"></span>
                <span class="side-menu__label"> {{trans('customer.developer')}}</span></a>
        </li>
        @endcan

        @can('manage_ticket')
        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.ticket.index')}}">
                <span class="side-menu__icon lead-3 fas fa-exclamation-triangle"></span>
                <span class="side-menu__label"> {{trans('customer.ticket.ticket')}}</span></a>
        </li>
        @endcan
        @if(auth('customer')->user()->type=='customer')
        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.staff.index')}}">
                <span class="side-menu__icon lead-3 fas fa-user-plus"></span>
                <span class="side-menu__label"> {{trans('Staff')}}</span></a>
        </li>
        @endif

        @can('manage_settings')

        <li class="slide">
            <a class="side-menu__item" href="{{route('customer.settings.index')}}">
                <span class="side-menu__icon lead-3 fas fa-cog"></span>
                <span class="side-menu__label"> {{trans('customer.settings')}}</span></a>
        </li>
        @endcan

    </ul>
</aside>
<!-- END SIDE MENU BAR -->