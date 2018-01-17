

<div class="wrap">
    <h1>{{ get_admin_page_title() }}</h1>


    <div class="tablenav top alignleft">
        <h2 class="screen-reader-text">Pages list navigation</h2>
        {!! $posts->links('pagination.wp') !!}
        <br class="clear">
    </div>

    <table class="wp-list-table widefat  striped">
        <thead>
        <tr>
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
            @foreach($posts as $post)
                <tr>
                    <td class="column-primary" data-colname="Event">

                        {{ $post->display_name }}
                    </td>
                    <td>
                        {{ $post->user_registered }}
                    </td>
                    <td>
                        {{ $post->user_email }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="tablenav bottom alignleft">
        {!! $posts->links('pagination.wp') !!}
    </div>
    <p> <a class="button button-primary" href="{{wp_nonce_url(admin_url('admin.php?page=lumen_page'),  'update', 'lumen_nonce' )}}">Do some action</a></p>


</div> <!-- .wrap -->





