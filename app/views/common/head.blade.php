<head>
    <base href="{{Config::get('template.url')}}"/>

    <!-- Page Title -->
    <title>{{Config::get('template.title')}}</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="Tours" />
    <meta name="description" content="{{Config::get('template.title')}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Theme Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/animate.min.css">

    <!-- Current Page Styles -->
    <link rel="stylesheet" type="text/css" href="components/revolution_slider/css/settings.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="components/revolution_slider/css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="components/jquery.bxslider/jquery.bxslider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="components/flexslider/flexslider.css" media="screen" />

    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="css/style.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Updated Styles -->
    <link rel="stylesheet" href="css/updates.css">

    <!-- Updated Styles -->
    <link rel="stylesheet" href="css/updates.css">

    <!-- Responsive Styles -->
    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

    @yield('css')

    <!-- CSS for IE -->
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie.css" />
    <![endif]-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->

    <!-- Javascript Page Loader
    <script type="text/javascript" src="js/pace.min.js" data-pace-options='{ "ajax": false }'></script>
    <script type="text/javascript" src="js/page-loading.js"></script> -->

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?31HoFAt9ctCW35vTGBrqboIiuVyGlDfC";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->
</head>