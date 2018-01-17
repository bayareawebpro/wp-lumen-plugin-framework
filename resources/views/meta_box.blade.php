@if(isset($post))
    <h1>{{ $post->post_title }}</h1>
    <p>{{ $post->post_modified->diffForHumans() }}</p>
@endif
<p><input type="text" name="lumen_new_title" value="{{ $post->post_title }}" class="regular-text" /></p>
