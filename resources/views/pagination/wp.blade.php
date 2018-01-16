@if ($paginator->hasPages())

    <div class="tablenav-pages">
        <span class="pagination-links">
            @if ($paginator->onFirstPage())
                <span class="tablenav-pages-navspan" aria-hidden="true">«</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
            @else
                <a class="first-page" href="{{ $paginator->url(1) }}">
                    <span class="screen-reader-text">First page</span>
                    <span aria-hidden="true">«</span>
                </a>
                <a class="prev-page" href="{{ $paginator->previousPageUrl() }}">
                    <span class="screen-reader-text">Previous page</span>
                    <span aria-hidden="true">‹</span>
                </a>
            @endif
                {{-- Pagination Elements --}}
                {{--@foreach ($elements as $element)--}}
                    {{-- "Three Dots" Separator --}}
                    {{--@if (is_string($element))--}}
                        {{--<a class="disabled"><span>{{ $element }}</span></a>--}}
                    {{--@endif--}}

                    {{-- Array Of Links --}}
                    {{--@if (is_array($element))--}}
                        {{--@foreach ($element as $page => $url)--}}
                            {{--@if ($page == $paginator->currentPage())--}}
                                {{--<a class="primary"><span>{{ $page }}</span></a>--}}
                            {{--@else--}}
                                {{--<a href="{{ $url }}">{{ $page }}</a>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--@endforeach--}}

            <span class="paging-input">
                <form method="get" style="display: inline-block">
                    <input type="hidden" name="page" value="{{ $_GET['page'] }}"/>
                    <label for="current-page-selector" class="screen-reader-text">Current Page</label>
                    <input class="current-page"
                           id="current-page-selector"
                           type="text"
                           name="users_page"
                           value="{{ $paginator->currentPage() }}"
                           size="2"
                           aria-describedby="table-paging">
                    <span class="tablenav-paging-text">
                        of <span class="total-pages">{{ round($paginator->total() / $paginator->perPage())  }}</span>
                    </span>
                </form>
            </span>
            @if (!$paginator->hasMorePages())
                <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">»</span>
            @else
                <a class="next-page" href="{{ $paginator->nextPageUrl() }}">
                    <span class="screen-reader-text">Next page</span>
                    <span aria-hidden="true">›</span>
                </a>
                <a class="next-page" href="{{ $paginator->url($paginator->lastPage() ) }}">
                    <span class="screen-reader-text">Last page</span>
                    <span aria-hidden="true">»</span>
                </a>
            @endif
        </span>

        <span class="displaying-num"> {{$paginator->total()}} items</span>
    </div>

@endif

