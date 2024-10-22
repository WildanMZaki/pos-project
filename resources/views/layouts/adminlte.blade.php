<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  @includeIf('layouts.adminlte.styles')
  @stack('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @includeIf('layouts.adminlte.header')
  
  @includeIf('layouts.adminlte.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @includeIf('layouts.adminlte.footer')

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

@includeIf('layouts.adminlte.scripts')
@stack('js')
</body>
</html>
