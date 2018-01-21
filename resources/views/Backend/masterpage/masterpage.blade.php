<!doctype html>
<html lang="en">
   <head>
      @include('Backend.masterpage.head')
   </head>
   <body>
      <div class="wrapper">
         <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
            <!--
               Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
               Tip 2: you can also add an image using data-image tag
               
               -->
              @include('Backend.masterpage.siderbar')
         </div>
         <div class="main-panel">
            @include('Backend.masterpage.navbar')
            <div class="content">
                @yield('content')
            </div>
            <footer class="footer">
                @include('Backend.masterpage.footer')
            </footer>
         </div>
      </div>
   </body>
   <!--   Core JS Files   -->
   <script src="{{ URL::asset('backend/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
   <script src="{{ URL::asset('backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
   <!--  Checkbox, Radio & Switch Plugins -->
   <script src="{{ URL::asset('backend/js/bootstrap-checkbox-radio-switch.js') }}"></script>
   <!--  Charts Plugin -->
   <script src="{{ URL::asset('backend/js/chartist.min.js') }}"></script>
   <!--  Notifications Plugin    -->
   <script src="{{ URL::asset('backend/js/bootstrap-notify.js') }}"></script>
   <!--  Google Maps Plugin    -->
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
   <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
   <script src="{{ URL::asset('backend/js/light-bootstrap-dashboard.js') }}"></script>
   <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
   <script src="{{ URL::asset('backend/js/demo.js') }}"></script>
   <script src="{{ URL::asset('backend/js/admin.js')}}"></script>
   <script src="{{ URL::asset('backend/js/jquery-confirm.min.js') }}"></script>
   <script type="text/javascript">
      $(document).ready(function(){
      
         	demo.initChartist();
      
      
      });
   </script>
</html>