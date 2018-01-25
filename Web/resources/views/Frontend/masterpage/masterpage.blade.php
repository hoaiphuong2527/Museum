<!DOCTYPE html>
<html lang="en">
    <head>
    @include('Frontend.masterpage.head')
    </head>
    <body>
        <!-- Index page -->
        <div class="top-menu">
            <!-- Top menu -->
            <div class="container">
            @include('Frontend.masterpage.header')
            </div>
            <!-- Top menu -->
            <!-- Logo-->
            @include('Frontend.masterpage.banner')
            <!-- End Logo-->
        </div>
        <!-- Main-->
        
        @yield('content')
     
        <!-- End Main -->
        <!-- Footer-->
        <footer id="footer">
        @include('Frontend.masterpage.footer') 
        </footer>
        <!-- Footer-->
    </body>
    
</html>