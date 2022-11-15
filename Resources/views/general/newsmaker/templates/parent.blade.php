<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="gdevilbat">
    <title>@yield('title', !empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS') | {{env('APP_NAME')}}</title>
    @section('meta_tag')
      <meta name="description" content="{{!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology'}}" />
      <meta name="keywords" content="{{!empty($settings->where('name','global')->flatten()[0]->value['meta_keyword']) ? $settings->where('name','global')->flatten()[0]->value['meta_keyword'] : env('APP_NAME')}}" />
      <meta property="og:type" content="website" />
      <meta property="og:title" content="{{!empty($settings->where('name','global')->flatten()[0]->value['fb_share_title']) ? $settings->where('name','global')->flatten()[0]->value['fb_share_title'] : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS'). ' | '.env('APP_NAME')}}"/>
      <meta property="og:description" content="{{!empty($settings->where('name','global')->flatten()[0]->value['fb_share_description']) ? $settings->where('name','global')->flatten()[0]->value['fb_share_description'] : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology')}}" />
      <meta property="og:image" content="{{!empty($settings->where('name','global')->flatten()[0]->value['fb_share_image']) ? asset($settings->where('name','global')->flatten()[0]->value['fb_share_image']) : ''}}"/>
      <meta property="og:image:alt" content="{{!empty($settings->where('name','global')->flatten()[0]->value['fb_share_title']) ? $settings->where('name','global')->flatten()[0]->value['fb_share_title'] : env('APP_NAME')}}" />
    @show
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="1024" />
    <meta property="og:url"           content="{{url()->full()}}" />
    @if(count(Request::input()) > 0)
        <link rel="canonical" href="{{url()->current()}}" />
    @endif
    <meta property="webcrawlers" content="all" />
    <meta property="spiders" content="all" />
    <meta property="robots" content="all" />
    <link rel="icon" type="image/png" sizes="1024x1024" href="{{!empty($settings->where('name','global')->flatten()->first()->value['favicon']) ? asset($settings->where('name','global')->flatten()->first()->value['favicon']) : ''}}">
    <meta name="google-site-verification" content="{{!empty($settings->where('name','global')->flatten()->first()->value['google_site_verification']) ? $settings->where('name','global')->flatten()->first()->value['google_site_verification'] : ''}}" />

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />

    <!-- Plugin-CSS -->
    {{Html::style(module_asset_url('appearance:assets/css/app.css'))}}
    @include('appearance::general/newsmaker/partials/page_style')
    
    <!-- Main-Stylesheets -->
    @yield('page_level_css')

    {{Html::style(module_asset_url('appearance:resources/views/general/newsmaker/css/main.css').'?id='.filemtime(module_asset_path('appearance:resources/views/general/newsmaker/css/main.css')))}}
    @yield('page_style_css')


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {!!!empty($settings->where('name','global')->flatten()->first()->value['meta_script']) ? $settings->where('name','global')->flatten()->first()->value['meta_script'] : ''!!}

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
     </script>
</head>

<body id="body">
    <h1 class="d-none">Judul Website</h1>

    <!-- Header -->
        @include('appearance::general/newsmaker/partials/header')
    <!-- End Header -->

    <main class="main">
        <!-- Mainmenu-Area -->
          @include('appearance::general/newsmaker/partials/sidebar')
        <!-- Mainmenu-Area-/ -->

        <section class="container">
            <div class="row">
               @yield('content')
                <div class="col">
                    <div class="footer-right">
                        <section id="list_1">
                            <div class="heading-bold heading-border-bottom">
                                <h4>Penulis Lepas</h4>
                            </div>
                            @include('appearance::general.newsmaker.partials.recomended_post')
                        </section>
                        @include('appearance::general.newsmaker.partials.footer')
                    </div>
                </div>
            </div>
        </section>
    </main>


     {{-- Javascript Core --}}
    <script type="text/javascript">
      var base = <?= "'".url('/')."'" ?>;
    </script>


    <!--Vendor-JS-->
    {{Html::script(module_asset_url('appearance:assets/js/app.js'))}}
    {{Html::script(module_asset_url('appearance:assets/js/slim.min.js'))}}
    {{Html::script(module_asset_url('appearance:assets/js/popper.min.js'))}}
    {{Html::script(module_asset_url('appearance:assets/fontawesome/js/all.min.js'))}}
    <!--Plugin-JS-->

    @include('appearance::general/newsmaker/partials/page_script')

    @yield('page_level_js')
    
    <!--Main-active-JS-->
    {{Html::script(module_asset_url('appearance:resources/views/general/newsmaker/js/main.js').'?id='.filemtime(module_asset_path('appearance:resources/views/general/newsmaker/js/main.js')))}}

    @yield('page_script_js')
</body>

</html>