@if(isset($children))
    <ul class="list-group">
        @foreach($children as $page)
            <li class="list-group-item">
                <a href="{{ trailingslashit($page->permalink) }}">

                    @if($request->url() == $page->permalink)
                        <strong>{{ $page->post_title }}</strong>
                    @else
                        <span>{{ $page->post_title }}</span>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
@endif