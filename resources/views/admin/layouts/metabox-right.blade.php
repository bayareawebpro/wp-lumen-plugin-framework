@yield('title')
<div class="wrap">
    @yield('heading')
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">

            <!-- main content -->
            <div id="post-body-content">
                @yield('content')
            </div><!-- post-body-content -->

            <!-- sidebar -->
            <div id="postbox-container-1" class="postbox-container">
                @yield('sidebar')
            </div><!-- #postbox-container-1 .postbox-container -->

        </div><!-- #post-body .metabox-holder .columns-2 -->
        <br class="clear">
    </div><!-- #poststuff -->
</div> <!-- .wrap -->