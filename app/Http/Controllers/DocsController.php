<?php namespace App\Http\Controllers;

use App\Helpers\LumenHelper;
use Illuminate\Http\Request;
use App\Models\WpPost;
use App\Models\WpTerm;

class DocsController extends Controller
{
	protected $helper;

    /**
     * Create a new controller instance.
     * @param LumenHelper $helper (injected automatically)
     * @param array $shortcode_attributes (injected automatically)
     */
    public function __construct(LumenHelper $helper, $shortcode_attributes)
    {

	    $this->helper = $helper;
	    $this->show();
    }

    public function show(){

	    $this->helper->request()->session()->put('test', str_random(16));
	    $this->helper->request()->session()->save(); //Save not required for routes.
	    echo $this->helper->request()->session()->get('test');

    	//WP 16 Queries
//	    $terms = get_terms( 'lumen_docs_category', array(
//		    'hide_empty' => false,
//	    ));
//
//	    foreach($terms as $term):
//		    $args = array(
//			    'post_type'              => array( 'lumen_docs' ),
//			    'nopaging'               => false,
//			    'paged'                  => '1',
//			    'posts_per_page'         => '10',
//			    'order'                  => 'DESC',
//			    'orderby'                => 'id',
//			    'tax_query' => array(
//				    array(
//					    'taxonomy' => 'lumen_docs_category',
//					    'field' => 'slug',
//					    'terms' => $term->slug,
//				    )
//			    )
//
//		    );
//		    $posts = new \WP_Query($args);
//
//		    echo $term->name;
//
//		    if( $posts->have_posts() ):
//			    while( $posts->have_posts() ) : $posts->the_post();
//				    echo the_content();
//				    echo the_permalink();
//				    echo get_post_meta($posts->ID, 'my_meta', true);
//			    endwhile;
//		    endif;
//
//	    endforeach;

		//WP with Eloquent: 3 Queries
//	    $lumen_docs_categories = WpTerm::with('posts','posts.meta')
//                       ->whereHas('taxonomy',function($query){
//                           $query->where('taxonomy', 'lumen_docs_category');
//                       })
//                       ->orderBy('term_order')
//                       ->paginate(10);


//	    foreach($lumen_docs_categories as $term){
//
//		    echo $term->name;
//
//		    foreach($term->posts as $post){
//
//			    echo $post->post_title;
//			    echo $post->post_content;
//			    echo $post->permalink;
//			    echo $post->meta->where('meta_name', 'my_meta')->first();
//	        }
//	    }


	    $lumen_docs_categories = $this->helper->cache()->remember('lumen_docs', 1, function(){

			return WpTerm::with('posts','posts.meta')
						->whereHas('taxonomy',function($query){
							$query->where('taxonomy', 'lumen_docs_category');
						})
						->orderBy('term_order')
						->paginate(10);

	    });


	    //dd($lumen_docs_categories);


    	echo $this->helper->view('docs', compact('lumen_docs_categories'));
    }
}
