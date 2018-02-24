@if($categories)
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach($categories as $index => $category)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading{{$index}}">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$index}}" aria-expanded="true" aria-controls="collapse{{$index}}">
                            {{ $category->name }}
                        </a>
                    </h4>
                </div>
                <div id="collapse{{$index}}" class="panel-collapse collapse @if($index < 1) in @endif" role="tabpanel" aria-labelledby="heading{{$index}}">
                    <div class="panel-body">
                        @foreach($category->posts as $index => $category_post)
                            @if($index > 0) <hr/> @endif
                            <p class="lead">{{$category_post->post_title}}</p>

                               {!! $category_post->post_content !!}


                            <p class="lead">Related Posts:</p>
                                @if($category_post->getMeta('related_articles'))
                                    <ul>
                                        @foreach($category_post->getMeta('related_articles', true) as $index => $related_post)
                                            <li> {{ $related_post->post_title }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif