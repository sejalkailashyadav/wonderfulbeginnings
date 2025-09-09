<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Cocomelon Learning Centre offers high-quality childcare programs designed to support the diverse needs of children and families">
		<meta name="author" content="Cocomelon Learning Center">
		<meta name="keywords" content="Cocomelon Learning Center, Infant and Toddler Care, Group Childcare, Junior Kindergarten, After School, Weekend Care">

		<!-- TITLE -->
		<title>Cocomelon Learning Center</title>

        <!-- BOOTSTRAP CSS -->
	    <link id="style" href="{{asset('build/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" >
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- APP CSS & APP SCSS -->
        @vite(['resources/css/app.css' , 'resources/sass/app.scss']) 

        @yield('styles')
        
	</head> 
    <body class="app ltr sidebar-mini light-mode">

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('build/assets/images/svgs/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- GLOBAL-LOADER -->
        @stack('scripts')
        
		<!-- PAGE -->
		<div class="page">

            <div class="page-main">
        
                <!-- App-Header -->
                @include('layouts.partials.header')
                <!-- End App-Header -->

                <!--App-Sidebar-->
                @if (!request()->routeIs('employee_masters'))
                        @include('layouts.partials.sidebar')
                    @endif

               
                <!-- End App-Sidebar-->

                <!--app-content open-->
				<div class="app-content main-content">
					<div class="side-app">
						<div class="main-container">
                        
                            @yield('content')

                        </div>
                    </div>
                    <!-- Container closed -->
                </div>            
                <!-- main-content closed -->

            </div>

            <!-- Footer opened -->
			@include('layouts.partials.footer')
            <!-- End Footer -->

		</div>
        <!-- END PAGE-->

        <!-- SCRIPTS -->
        @include('layouts.partials.scripts')
        
        <!-- APP JS-->
		@vite('resources/js/app.js')
        <!-- END SCRIPTS -->


</body>
