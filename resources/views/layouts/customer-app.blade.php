<?php
	$themeClass = '';
	if (!empty($_COOKIE['theme'])) {
		if ($_COOKIE['theme'] == 'dark') {
			$themeClass = 'dark-theme';
		} else if ($_COOKIE['theme'] == 'light') {
			$themeClass = 'light-theme';
		}  
	}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- METADATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="" name="description">
		<meta content="" name="author">
		<meta name="keywords" content=""/>
		
        <!-- CSRF TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- TITLE -->
        <title>@yield('title')-{{ config('app.name') }}</title>
        
        @include('layouts.header')
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

		<style>
		.btn {
    border-radius: 4px!important;
		}
		
	  </style>
	@yield('extra-css')
    <style>
        .select2-container .select2-selection--single{
            height: 37px !important;
        }
        .lang-colour i{
            color: black;
            font-size: 24px;
        }
    </style>


	</head>

	<body class="app sidebar-mini <?php echo $themeClass; ?>">

		<!-- LOADER -->
		{{-- <div id="preloader" >
			<img src="{{URL::asset('img/svgs/preloader.gif')}}" alt="loader">           
		</div> --}}
		<!-- END LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

             @include('layouts.includes.customer_sidebar')


				<!-- APP CONTENT -->			
				<div class="app-content main-content">

					<div class="side-app">

					@include('layouts.customer-nav-top')

                        {{-- @include('layouts.flash') --}}

						@yield('page-header')

						@yield('content')						

                    </div>                   
                </div>
                <!-- END APP CONTENT -->

		 @include('layouts.footer')               

            </div>		
        </div><!-- END PAGE -->
        <!-- Confirmation modal -->
<div class="modal fade" id="modal-confirm">
    <div class="modal-dialog">
        <form id="modal-form">
            @csrf
            <div id="customInput"></div>
        <div class="modal-content">
            <div class="modal-header p-2">
                <h4 class="modal-title">{{trans('customer.confirmation')}}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer p-2">
                <button id="modal-confirm-btn" type="button" class="btn btn-primary btn-sm">{{trans('customer.confirm')}}</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{trans('customer.cancel')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
		@include('layouts.footer-backend')  

	<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

	<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<style>
       
    </style>
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

	<script>
    jQuery('button[type="submit"]').on('click', function (e) {
        var form = $(this).parents('form:first');
        if (form.valid()) {
            $(this).attr('disabled', 'disabled').addClass('disabled')
            $(this).html(' <i class="fa fa-spinner fa-spin"></i> Loading');
            form.submit();
        }
    });
    jQuery('#modal-confirm-btn').on('click', function (e) {
        var form = $(this).parents('form:first');
        if (form.valid()) {
            $(this).attr('disabled', 'disabled').addClass('disabled')
            $(this).html(' <i class="fa fa-spinner fa-spin"></i> Loading');
            form.submit();
        }
    });
</script>
<script>
    $(document).on('click','.gateway-bb', function (e){
        const type = $(this).attr('data-type');
        localStorage.setItem("gateway_type", type);
    });
    $(document).on('click','.sending-setting', function (e){
        const type = $(this).attr('data-type');
        localStorage.setItem("sending_setting", type);
    });

</script>
<script>
    if ('{{request()->segment(2)== 'settings'}}') {
        const gateway = localStorage.getItem("gateway_type");
        const sending_setting_nav = localStorage.getItem("sending_setting");

        if (gateway) {
            $("#" + gateway).trigger('click');
            $('.gateway-bb').addClass('active');
        }
        if (sending_setting_nav) {
            $("#" + sending_setting_nav).trigger('click').addClass('active');
            $('.sending-setting').addClass('active');
        }
    }else {
        localStorage.clear();
    }
</script>
<script>
    $( document ).ready(function() {
        $('.form-control-sm').attr('placeholder', 'Type here to search...');
    });
</script>

@if(session()->has('success') || session()->has('fail') || count($errors)>0)
<x-alert :type="session()->get('success')?'success':'danger'" :is-errors="$errors" :message="session()->get('success')??session()->get('fail')"/>
@endif
<script src="{{asset('plugins/select2/js/select2.full.js')}}"></script>
@yield('extra-scripts')

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
    float: right;
    margin-left: -3px;
    margin-right: 18px;
    padding-right: -9px;
}
/* Set the <li> element to have relative positioning */
.select2-selection__choice {
  position: relative;
}

/* Position the <span> element absolutely to the right */
.select2-selection__choice__remove {
  position: absolute;
  right: 0;
}

</style>

























	</body>
</html>


