<!DOCTYPE html>
<html>
    <head>
        <base href="">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Blank - Arctic Admin Dashboard</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400|Roboto:300,400,500,700,900|Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;0,700;1,400&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{str_replace('https','https',URL::to('/'))}}/assets/css/vendors.bundle.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.9.1/styles/github.min.css">
        <link rel="stylesheet" href="{{str_replace('https','https',URL::to('/'))}}/assets/css/main.bundle.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style> 
            .topTable{
                margin-top: 4em;
                width: 120%;
            }
            .accordion
            {
                max-width:1000px;
            }
            .accordion .contentBx
            {
                position:relative;
                margin: 10px 20px;
            }
            .accordion .contentBx .label
            {
                position:relative;
                margin: 6px;
                box-shadow: 0px 0.5px 0.5px gray;
                font-size: 16px;
                cursor: pointer;
                padding: 0.1%;
            }
            .accordion .contentBx .label::before
            {
                content: "+";
                position: absolute;
                top: 50%;
                right: 20px;
                transform: translateY(-55%);
                font-size: 2em;
            }
            .accordion .contentBx.active .label::before
            {
                content: '-'
            }
            .accordion .contentBx .content
            {
                position: relative;
                height:0;
                overflow: hidden;
                transition: 0.8s;
                overflow-y: auto;
            }
            .accordion .contentBx.active .content
            {
                height: 150%;
                padding: 20px;
                margin: auto;
            }
            .main-content-wrap {
                margin: 1em auto 0 1px ;
                float: left;
                width: 80%;
            }




        </style>
    </head>

    <body>

        <div class="app-admin-wrap-layout-4 sidebar-full" >
            <div class="narrow-sidebar"><span class="m-auto"> </span>
                <button class="btn btn-primary rounded-circle btn-sm btn-icon text-white mr-0 my-sm" data-toggle="tooltip" data-placement="left" title="Cart"><i class="material-icons">shopping_cart</i></button>
                <button class="btn btn-primary rounded-circle btn-sm btn-icon text-white mr-0 my-sm" data-toggle="tooltip" data-placement="left" title="Messages"><i class="material-icons">chat</i></button><span class="m-auto"></span>
            </div>
            <div class="main-content-wrap" >
                <!-- header start-->
                <div class="ul-mobile-top-header bg-slate"><img class="ul-brand-mobile" src="assets/images/arctic-admin-circle.svg" alt="">
                    <div class="flex-grow-1"></div>
                    <button class="btn btn-icon btn-primary rounded-circle ul-header-menu-toggle text-white"><i class="material-icons">menu</i></button><i class="material-icons text-white ul-mobile-header-toggle">more_vert</i>
                </div>
                
                <div class="ul-header-4 px-md">
                    <div class="ul-header-4-content" >
                        <div class="ul-header-topbar" style="width:95%">
                            <h1 style="min-width: -webkit-fill-available !important;">DHD SRL</h1>
                            <div class="dropdown profile-dropdown">
                                <div class="header-btn-group">
                                    <button class="btn btn-secondary rounded-circle btn-icon" style="background-color: gray;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="rounded-circle" src="assets/images/faces/1.jpg" alt=""></button>
                                    <div class="dropdown-menu">
                                        <script type="text/javascript">
                                            function exit() {
                                                $.ajax({
                                                    url: '{{route("login", 1)}}',
                                                    type: 'DELETE',
                                                    success: function(result) {
                                                        if(result == '1'){
                                                            window.location.href="{{route('login')}}";
                                                        }
                                                    }
                                                });
                                            }
                                        </script>
                                        <a class="dropdown-item" onclick="exit();"><i class="material-icons mr-2">exit_to_app</i>Salir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- header close-->
               
                <div class="d-flex ul-inner-layout-4">
                    @if(session('logged'))

                        @if(session('profiletype')=="1")
                            <div class="topTable"  style=" width:18%;">
                                <div class="ul-sidebar-4 mr-xxxl" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                                    <div class="ul-sidebar-4-items" >
                                        <p class="text-muted text-12 text-uppercase font-weight-semi mb-1">GENERAL</p>
                                        <ul>
                                            <!-- <li><a href="#" style="color: darkgray !important;"><i class="mr-2" data-feather="grid"></i>Facturas</a></li> -->
                                            <li><a href="{{route("cash.index")}}" ><i class="mr-2" data-feather="grid"></i>Caja Interna</a></li>
                                            <li><a href="{{route("cash2.index")}}" ><i class="mr-2" data-feather="grid"></i>Caja Operador</a></li>
                                            <li><a href="{{route("remitos.index")}}" ><i class="mr-2" data-feather="grid"></i>Remitos</a></li>
                                            <li><a href="{{route("resumen.index")}}" ><i class="mr-2" data-feather="grid"></i>Resum. Diario</a></li>
                                            <li><a href="{{route("resumenmonthly.index")}}" ><i class="mr-2" data-feather="grid"></i>Res. Men. y CC</a></li>
                                            <div class="pb-md"></div>
                                            <p class="text-muted text-12 text-uppercase font-weight-semi mb-1">CONFIGURACIONES</p>
                                            <li><a style="cursor: default"><i class="mr-2" data-feather="sliders"></i>Altas Generales</a>
                                                <ul>
                                                    <li><a class=" m-0" href="{{route("clients.index")}}">Clientes</a></li>
                                                    <li><a class=" m-0" href="{{route("clientsbyservices.index")}}">Servicios de Clientes</a></li>
                                                    <li><a class=" m-0" href="{{route("cashincome.index")}}">Ingresos por Caja</a></li>
                                                    <li><a class=" m-0" href="{{route("cashoutcome.index")}}">Egresos por Caja</a></li>
                                                    <li><a class=" m-0" href="{{route("users.index")}}">Usuarios</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="topTable"  style=" width:18%;">
                                <div class="ul-sidebar-4 mr-xxxl" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                                    <div class="ul-sidebar-4-items" >
                                        <p class="text-muted text-12 text-uppercase font-weight-semi mb-1">GENERAL</p>
                                        <ul>
                                            <!-- <li><a href="#" style="color: darkgray !important;"><i class="mr-2" data-feather="grid"></i>Facturas</a></li> -->
                                            @if($_SERVER['HTTP_HOST'] != 'dhdsrl.app')
                                                <li><a href="https://localhost/dhdsrl/dhdsrl/laravel/public/cash2_render/{{date('Y-m-d')}}" ><i class="mr-2" data-feather="grid"></i>Caja</a></li>
                                            @else
                                                <li><a href="https://dhdsrl.app/cash2_render/{{date('Y-m-d')}}" ><i class="mr-2" data-feather="grid"></i>Caja</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endif
                    <div class="ul-sidebar-4-overlay"> </div>
                    <!-- main content start-->
                    @if(session('logged') || $generalModul == 'Login')

                        <div class="main-content-body-layout-4 ">
                            <div class="topTable"  style="width:120%">
                                
                                <script>
                                    const accordion = document.getElementsByClassName('contentBx');
                                    
                                    for(i=0; i< accordion.length; i++){
                                        accordion[i].addEventListener('click', function(){
                                            this.classList.toggle('active')
                                        })

                                    }

                                </script>
                                
                                <div class="subheader px-lg">
                                    <div class="subheader-container">
                                        <div class="subheader-main" >
                                            <h3 class="subheader-title" style="cursor: default;" >{{$generalModul}}</h3>
                                            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                                                <ol class="ul-breadcrumb-items">
                                                    <li class="breadcrumb-item" style="cursor: default"><a>{{$parenModul}}</a></li>
                                                    <li class="breadcrumb-item" aria-current="page" style="cursor: default">{{$modulName}}</li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-lg">
                                    @yield('content')
                                </div>
                            </div>
                        </div>

                    @else
                        <script>
                            window.location.href="{{route('login')}}";
                        </script>
                    @endif
                </div>
            </div>
        </div>

        <div class="ul-sidebar-panel-overlay"> </div>
        <script src="{{str_replace('https','https',URL::to('/'))}}/assets/js/vendors.bundle.min.js"></script>
        <script src="{{str_replace('https','https',URL::to('/'))}}/assets/js/main.bundle.min.js"></script>
        <script src="{{str_replace('https','https',URL::to('/'))}}/assets/vendors/feather-icons/dist/feather.min.js"></script>
        <script src="{{str_replace('https','https',URL::to('/'))}}/assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{str_replace('https','https',URL::to('/'))}}/assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js" integrity="sha512-i8ERcP8p05PTFQr/s0AZJEtUwLBl18SKlTOZTH0yK5jVU0qL8AIQYbbG5LU+68bdmEqJ6ltBRtCxnmybTbIYpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>
        @yield('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </body>
</html>