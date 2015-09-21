<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->

@include('common.admin.head')

<body data-ng-app="App">
    <div id="page-wrapper">
    
        @include('common.admin.header')

        @section('breadcrumbs')
        @show

        <section id="content" class="gray-area">
            <div class="container">
                <div id="main">
                    @section('content')
                    @show
                </div>
            </div>
        </section>
    </div>


    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.noconflict.js"></script>
    <script type="text/javascript" src="js/modernizr.2.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="js/jquery-ui.1.10.4.min.js"></script>
    
    <!-- Twitter Bootstrap -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    
    <!-- parallax -->
    <script type="text/javascript" src="js/jquery.stellar.min.js"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="js/waypoints.min.js"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="js/theme-scripts.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>

    <script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>

    <script type="text/javascript" src="js/angular.min.js"></script>

    <script type="text/javascript" src="app/app.js"></script>
    <script type="text/javascript" src="app/admin/admin.js"></script>
    <script type="text/javascript" src="app/admin/busca/buscaController.js"></script>
    <script type="text/javascript" src="app/admin/busca/models/hotelModel.js"></script>
    <script type="text/javascript" src="app/admin/busca/models/apartamentoModel.js"></script>
    <script type="text/javascript" src="app/admin/busca/directives/buscaDirective.js"></script>

    {{ Rapyd::scripts() }}

    @section('scripts')

    @show
    
</body>
</html>

