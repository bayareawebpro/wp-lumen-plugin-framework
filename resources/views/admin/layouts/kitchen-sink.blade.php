@if(isset($_REQUEST['dump']))

    <link rel="stylesheet" href="http://illumine.local/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load%5B%5D=dashicons,admin-bar,common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menus,wp-pointer,widgets&amp;load%5B%5D=,site-icon,l10n,buttons,wp-auth-check&amp;ver=4.8.2" type="text/css" media="all">
    <style type="text/css">
        body{
            padding: 50px !important;
            height:auto !important;
            min-height: auto !important;
        }
    </style>
    @include('admin.parts.'.$_REQUEST['dump'])


@else
    @php get_header(); @endphp

    <!--content-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Blade Template with WP Theme Includes</div>

                    <div class="panel-body">

<p class="lead">Card</p>
@component('components.snippet')
@slot('code')
&#64;component('admin.parts.card')
    &#64;slot('title')
        Card Title
    &#64;endslot
    &#64;slot('content')
        Card Content
    &#64;endslot
&#64;endcomponent
@endslot
@endcomponent
<iframe src="http://illumine.local/examples/ui-elements/admin?dump=card" width="100%" height="250px" frameborder="0"></iframe>
<hr/>


                        <p class="lead">Color Pallets</p>
                        <iframe src="http://illumine.local/examples/ui-elements/admin?dump=colors" width="100%" height="250px" frameborder="0"></iframe>
                        <hr/>
                        <p class="lead">Form Elements</p>
                        <iframe src="http://illumine.local/examples/ui-elements/admin?dump=form" width="100%" height="250px" frameborder="0"></iframe>

                        {{--<hr/>--}}
                        {{--@include('admin.parts.card')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.colors')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.form')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.menu-bubble')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.notices')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.pagination')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.spinner')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.tables')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.parts.tabs')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.layouts.metabox-left')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.layouts.metabox-right')--}}
                        {{--<hr/>--}}
                        {{--@include('admin.layouts.two-columns')--}}
                        {{--<hr/>--}}
                    </div>
                </div>
            </div>
            @php get_sidebar(); @endphp
        </div>
    </div>
    <!--content-->
    @php get_footer(); @endphp
@endif
