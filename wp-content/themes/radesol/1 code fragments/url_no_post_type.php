<?php  // 
/* Simple url for post types */
function custom_remove_cpt_slug( $post_link, $post, $leavename ) {
	if( in_array($post->post_type, array('country')) and ($post->post_status == 'publish') and !$post->post_parent ) { //  and !$post->post_parent
	$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
	}
    return $post_link;
}
add_filter( 'post_type_link', 'custom_remove_cpt_slug', 10, 3 );
function custom_parse_request_tricksy( $query ) {
    if ( !$query->is_main_query() ) return;
    if ( 2 != count( $query->query ) || !isset($query->query['page']) ) { return; }
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'page', 'country' ) );
    }
}
add_action( 'pre_get_posts', 'custom_parse_request_tricksy' );
?>
