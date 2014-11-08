<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

/**************************************************************************
* Store Plan on Site Creation.
**************************************************************************/
function ins_add_plan_type_on_creation( $blog_id, $user_id ) {

	/* get the site type from the user meta */
	$ins_user_site_type = get_user_meta( $user_id, 'ins_site_type', true );

	/* switch to the new blog that has been created */
	switch_to_blog( $blog_id );

	/* update this sites option for site type to the site type of the user */
	update_option( 'ins_site_type', $ins_user_site_type );

	/* switch depending on the site type */
	switch( $ins_site_type ) {

	    /* if this is a bronze site */
	    case 'bronze':

	        break;

	    case 'silver':

	        break;

	} // end switch statement

	/* restore the db context back to the original blog */
	restore_current_blog();

}
add_action( 'wpmu_new_blog', 'ins_add_plan_type_on_creation', 10, 2 );


/**
 * Add custom post for set the blog template.
 */
function ins_template_filter($input, $field, $value, $lead_id, $form_id){
	if( $field['label'] == 'site-template' ){
		$input = '<input type="hidden" id="blog_template" name="blog_template" value="3">';
	}

	if( $field['cssClass'] == 'site-plan'){
		$input = "Whatever dude";
	}

	return $input;
}

add_filter("gform_field_input", "ins_template_filter", 10, 5);
