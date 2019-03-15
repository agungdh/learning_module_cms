<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @php
  $currentMenuTitle = ADHhelper::getCurrentMenuTitle();
  @endphp
  <title>{{$currentMenuTitle ? $currentMenuTitle . ' |' : null }} {{env('APP_NAME')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link id="favicon" rel="icon" type="image/x-icon" href="{{asset('storage/assets')}}/favicon/favicon.ico">

  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/sweetalert-1.1.3/dist/sweetalert.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/select2/dist/css/select2.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/plugins/pace/pace.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  @yield('css')

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('main.index') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>LM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>LM</b>CMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('storage/assets')}}/AdminLTE-2.4.5/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{session('login') ? ADHhelper::getUserData()->nama : "Nama"}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('storage/assets')}}/AdminLTE-2.4.5/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  {{session('login') ? ADHhelper::getUserData()->nama : "Nama"}}
                  <small>{{session('login') ? ADHhelper::getUserData()->username : "Username"}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('main.profil')}}" class="btn btn-primary">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('main.logout')}}" class="btn btn-danger">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @php
        $currentRouteSlug = ADHhelper::getCurrentRouteSlug();
        $currentRoute = ADHhelper::getCurrentRoute();
        $menuId = ADHhelper::getMenuIdByRouteSlug($currentRouteSlug);

        if ($menuId) {
          $bolds = ADHhelper::menuBoldParents($menuId);
        } else {
          $bolds = [];
        }
        @endphp
        @foreach(ADHhelper::templateMenu() as $lvl1)
          @if($lvl1->route == null)
          <li class="treeview {{in_array($lvl1->id, $bolds) ? 'active' : null}}">
            <a href="#">
              <i class="{{$lvl1->icon}}"></i> <span>{{$lvl1->menu}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @foreach($lvl1->childs as $lvl2)
                @if($lvl2->route == null)
                <li class="treeview {{in_array($lvl2->id, $bolds) ? 'active' : null}}">
                    <a href="#"><i class="{{$lvl2->icon}}"></i> {{$lvl2->menu}}
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @foreach($lvl2->childs as $lvl3)
                      @if($lvl3->route == null)
                        <li class="treeview {{in_array($lvl3->id, $bolds) ? 'active' : null}}">
                          <a href="#"><i class="{{$lvl3->icon}}"></i> {{$lvl3->menu}}
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                              @foreach($lvl3->childs as $lvl4)
                                  @if(env('SHOW_ALL_MENU') || ADHhelper::authCan($lvl4->route))
                                    <li class="{{$lvl4->id == $menuId ? 'active' : null}}">
                                      <a href="{{ route($lvl4->route) }}">
                                        <i class="{{$lvl4->icon}}"></i> <span>{{$lvl4->menu}}</span>
                                      </a>
                                    </li>
                                  @endif
                              @endforeach
                          </ul>
                        </li>
                      @else
                          @if(env('SHOW_ALL_MENU') || ADHhelper::authCan($lvl3->route))
                            <li class="{{$lvl3->id == $menuId ? 'active' : null}}">
                              <a href="{{ route($lvl3->route) }}">
                                <i class="{{$lvl3->icon}}"></i> <span>{{$lvl3->menu}}</span>
                              </a>
                            </li>
                          @endif
                      @endif
                    @endforeach
                  </ul>
                </li>
                @else
                  @if(env('SHOW_ALL_MENU') || ADHhelper::authCan($lvl2->route))
                    <li class="{{$lvl2->id == $menuId ? 'active' : null}}">
                      <a href="{{ route($lvl2->route) }}">
                        <i class="{{$lvl2->icon}}"></i> <span>{{$lvl2->menu}}</span>
                      </a>
                    </li>
                  @endif
                @endif
              @endforeach
            </ul>
          </li>
          @else
            @if(env('SHOW_ALL_MENU') || ADHhelper::authCan($lvl1->route))
              <li class="{{$lvl1->id == $menuId ? 'active' : null}}">
                <a href="{{ route($lvl1->route) }}">
                  <i class="{{$lvl1->icon}}"></i> <span>{{$lvl1->menu}}</span>
                </a>
              </li>
            @endif
          @endif
        @endforeach

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
      <ol class="breadcrumb">
        @yield('nav')
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a target="_blank" href="https://github.com/agungdh/learning_module_cms">LMCMS</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<!-- SweetAlert -->
<script src="{{asset('storage/assets')}}/sweetalert-1.1.3/dist/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- fullCalendar -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/moment/moment.js"></script>
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/fullcalendar/dist/locale/id.js"></script>
<!-- PACE -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/PACE/pace.min.js"></script>
<!-- Slimscroll -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
<script type="text/javascript">
$(document).ajaxStart(function () {
  Pace.restart();
})

$('.datatable').DataTable({
  responsive: false,
  "scrollX": true
});
$('.select2').select2();
$('.datepicker').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true,
  language: 'id'
});
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
FastClick.attach(document.body);
</script>
<!-- AdminLTE App -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
@yield('js')
@if(session('alert'))
<script type="text/javascript">
    swal('{{ session('alert')['title'] }}', '{{ session('alert')['message'] }}', '{{ session('alert')['class'] }}');
</script>
@endif
</body>
</html>
