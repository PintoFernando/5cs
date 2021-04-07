<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    
            
  
      
        
     
    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->

  <script src="{{asset('admin2/bower_components/jquery/dist/jquery.min.js')}}"></script>
  @stack('scripts')

  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('/admin2/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('/admin2/dist/js/adminlte.min.js')}}"></script>

  <!--ajax cruds-->

  <script src="{{asset('/admin2/dist/js/crudajax/user.js')}}"></script>
  <!--select min-->
  <script src="{{asset('/admin2/dist/js/bootstrap-select.min.js')}}"></script>
  <!--- ajax-->
  {{-- dataTables --}}
  <script src="{{asset('/admin2/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('/admin2/datatables/pdfmake.min.js')}}"></script>
  <script src="{{asset('/admin2/datatables/vfs_fonts.js')}}"></script>

  {{-- Validator --}}
  <script src="{{ asset('/ajax/validator/validator.min.js') }}"></script>
  <script src="{{ asset('/ajax/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

  <!-- {{-- PrintArea--}}
   <script src="{{asset('admin2/dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('admin2/dist/js/jquery.PrintArea.js')}}"></script> -->

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

  <!--script para ajax crud-->
  
</body>

</html>