<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{isset($subbagian) ? $subbagian->bagian : "Table Of Content"}} | {{$modul->modul}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link id="favicon" rel="icon" type="image/x-icon" href="{{asset('storage/assets')}}/favicon/favicon.ico">

  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
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

</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('read.index', $modul->id) }}" class="logo">
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


    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="{{!isset($bagian) && !isset($subbagian) ? "active" : null}}">
            <a href="{{route('read.index', $modul->id)}}">
              <i class="fa fa-list"></i> <span>Table Of Content</span>
            </a>
          </li>

          @foreach($modul->bagians as $menuBagian)
          <li class="treeview {{ isset($bagian) && $bagian->id == $menuBagian->id ? "active" : null}}">
            <a href="#">
              <i class="fa fa-file-text"></i> <span> {{$menuBagian->bagian}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @foreach($menuBagian->childs as $menuSubBagian)
              <li class="{{ isset($subbagian) && $subbagian->id == $menuSubBagian->id ? "active" : null}}"><a href="{{route('read.read', [$modul->id, $menuBagian->posisi, $menuSubBagian->posisi])}}"><i class="fa fa-circle-o"></i> {{$menuSubBagian->bagian}}</a></li>
              @endforeach
            </ul>
          </li>
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
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{route('main.index')}}">LMCMS</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/PACE/pace.min.js"></script>
<!-- FastClick -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
<script type="text/javascript">
$(document).ajaxStart(function () {
  Pace.restart();
})

FastClick.attach(document.body);
</script>
<!-- AdminLTE App -->
<script src="{{asset('storage/assets')}}/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
@yield('js')
</body>
</html>
