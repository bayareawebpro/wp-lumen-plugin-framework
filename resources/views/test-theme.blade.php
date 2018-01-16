@php get_header(); @endphp

<!--content-->
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-9 col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">Blade Template with WP Theme Includes</div>

                <div class="panel-body">
                    <p>Behold, we render a template using the router and include our WP Theme parts by calling get_header, get_sidebar and get_footer!</p>

                    <table class="table table-striped">
                        @foreach(range(1,10) as $index => $value)
                            <tr>
                            @foreach(range(1,10) as $multiple)
                                        @if($multiple > 1)
                                        <td>
                                            {{ ($value * $multiple) }}
                                        </td>
                                        @else
                                        <th>
                                            {{ ($value * $multiple) }}
                                        </th>
                                        @endif
                            @endforeach
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
		@php get_sidebar(); @endphp
    </div>
</div>
<!--content-->
@php get_footer(); @endphp
