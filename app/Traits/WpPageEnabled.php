<?php namespace App\Traits;
trait WpPageEnabled{

	/**
	 * Set WP Page Title & Silence 404s
	 * @param  string  $pageTitle
	 * @return void
	 */
	public function setPageTitle($pageTitle = null){
		global $wp_query;
		$wp_query->is_404=false;
		if(!is_null($pageTitle)){
			add_filter('document_title_parts', function($titleParts) use ($pageTitle) {
                $titleParts['title'] = $pageTitle;
				return $titleParts;
			}, 10000, 2);
		}
	}
}