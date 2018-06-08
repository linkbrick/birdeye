<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo.png') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet"/>
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{--custom css--}}
    @stack('styles')
    <style>
    .clickable{
            cursor: pointer;
    }
    .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #overlay {
            position: fixed; /* Sit on top of the page content */
            display: none; /* Hidden by default */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5); /* Black background with opacity */
            z-index: 1050; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer; /* Add a pointer on hover */
        }

        .hidden{display: none; visibility: hidden;}
    </style>

</head>
<body>
<div class="wrapper">
    @include('layouts.partials._tenant_sidebar')

    <div class="main-panel">
        @include('layouts.partials._topbar')
        <div class="content">
            @include('layouts.partials._notifications')
            <div id="app" style="min-height:650px">
                @yield('content')
            </div>
            @include('layouts.partials._footer')
        </div>
    </div>

    <!-- Scripts -->
    <script>
        window.generic = {
            "csrfToken": "{{ csrf_token() }}",
            mixins: []
        };
    </script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script src="{{ asset('js/material.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/chartist.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.6.0/src/loadingoverlay.min.js"></script>
    <script src="{{ asset('js/setting.js') }}"></script>
    <script>
        function setFormValidation(id) {
            $(id).validate({
                errorPlacement: function(error, element) {
                    $(element).closest('div').addClass('has-error');
                }
            });
        }
    </script>
    
    @stack('scripts')
    <script src="{{ asset('js/vue_init.js') }}"></script>
    <script src="{{ asset('js/Rx.js') }}"></script>
    <script>
        const loadingSpinner={
            show:function(){document.getElementById("overlay").style.display = "block"},
            hide:function(){document.getElementById("overlay").style.display = "none"}
        };
        $( document ).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            //nav bar display setting
            const menus = $("ul.nav>li>a");
            let menuIter = menus.length;
            while(menuIter--){
                if (window.location.href.indexOf($(menus[menuIter]).attr("href"))!==-1||window.location.href.indexOf($(menus[menuIter]).data("bind"))!==-1){
                    //set menu active
                    $(menus[menuIter]).parent().addClass("active");
                    //expand submenu if under a parent menu
                    if ($(menus[menuIter]).parent().parent().parent().hasClass("collapse")){
                        $(menus[menuIter]).parent().parent().parent().collapse("show")
                    }
                    //scroll to that menu
                    setTimeout(function(){
                        menus[menuIter].scrollIntoView();
                    },1000)

                    break;
                }
            };
           $(".nav-item.active").css({"background-color":"#e91e63"});

            $("select.selectpicker").each(function(a,b){
                if ($(b).data("live-search")){
                    $(b).parent().parent().removeClass("is-empty");
                }
            });

        });


    </script>
</div>
<div id="overlay"><div class="loader"></div></div>
</body>
</html>
