@if(isset($post))
    <h1>Lumen MetaBox Test</h1>
    <p>Post Date: {{ $post->post_modified->diffForHumans() }}</p>
@endif
<p><textarea name="lumen_meta_test" class="regular-text">{{ $post->getMeta('lumen_meta_test') }}</textarea></p>
