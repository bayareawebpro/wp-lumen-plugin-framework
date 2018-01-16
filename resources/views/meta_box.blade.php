@if(isset($post))
<h1>{{ $post->post_title }}</h1>
@endif
<p><input type="text" name="lumen_new_title" value="as123231" class="regular-text" /></p>

<h1>{{ $post->post_modified->diffForHumans() }}</h1>
