

<div class="wrap">


    <h1>{{ get_admin_page_title() }}</h1>


    {{--<h2 class="screen-reader-text">Filter pages list</h2>--}}
    {{--<p class="search-box">--}}
        {{--<label class="screen-reader-text" for="post-search-input">Search:</label>--}}
        {{--<input type="search" id="post-search-input" name="s" value="">--}}
        {{--<button type="submit" id="search-submit" class="button">Search</button>--}}
    {{--</p>--}}
    {{--<ul class="subsubsub">--}}
        {{--<li class="all"><a href="edit.php?post_type=page" class="current">All <span class="count">(25)</span></a> |</li>--}}
        {{--<li class="publish"><a href="edit.php?post_status=publish&amp;post_type=page">Published <span class="count">(25)</span></a> |</li>--}}
        {{--<li class="trash"><a href="edit.php?post_status=trash&amp;post_type=page">Trash <span class="count">(1)</span></a></li>--}}
    {{--</ul>--}}

    <div class="tablenav top alignleft">
        <h2 class="screen-reader-text">Pages list navigation</h2>
        {!! $users->links('pagination.wp') !!}
        <br class="clear">
    </div>


    <table class="wp-list-table widefat  striped">
        <thead>
        <tr>
            <td id="cb" class="manage-column column-cb check-column">
                <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                <input id="cb-select-all-1" type="checkbox">
            </td>
            <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
                <a href="?orderby=title&amp;order=asc"><span>Title</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col">Date Registered</th>
            <th scope="col">Email</th>
            <th scope="col">Location</th>
        </tr>
        </thead>
        <tbody>
        <ul>
            @foreach($users as $user)
                <tr id="post-81">
                    <th scope="row" class="check-column">
                        <label class="screen-reader-text" for="cb-select-81">Select Documentation</label>
                        <input id="cb-select-81" type="checkbox" name="post[]" value="81">
                    </th>
                    <td class="column-primary" data-colname="Event">

                        {{ $user->display_name }}
                    </td>
                    <td>
                        {{ $user->user_registered }}
                    </td>
                    <td>
                        {{ $user->user_email }}
                    </td>
                    <td>
                        The Daily Planet
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="tablenav bottom alignleft">
        {!! $users->links('pagination.wp') !!}
    </div>
    {{--<p> <a class="button button-primary" href="{{wp_nonce_url(admin_url('admin.php?page=lumen_page'),  'update', 'lumen_nonce' )}}">Do some action</a></p>--}}
    {{--<!-- #poststuff -->--}}

</div> <!-- .wrap -->





