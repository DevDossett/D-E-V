<?php
/* 
* template name: Dashboard
*/
if(!is_user_logged_in()){
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); exit();
}
