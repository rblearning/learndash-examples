<?php
// Adds users registered via gravity forms to learndash groups with specific forms
add_action( 'gform_user_registered', 'add_to_learndash_groups_by_id', 10, 4 );
function add_to_learndash_groups_by_id( $user_id, $feed, $entry ){

// Gets the form ID
$formid = rgar( $feed, 'form_id' );

// Add form IDs you want to target
if ($formid == 12){

// Replace 1180 and 2288 with the IDs of the groups you want to add new users to
$learndash_group_ids = array( 1180, 2288 );

// adds the users to the groups (https://bitbucket.org/snippets/learndash/MK6Rp/learndash-add-new-user-to-group)

learndash_set_users_group_ids( $user_id, $learndash_group_ids );
}
 
// do something else if the form ID isn't what you want, like add them to a different set of groups
else{

// Replace 2222 and 2156 with the IDs of the groups you want to add new users to
$learndash_group_ids = array( 2222, 2156 );

// adds the users to the groups (https://bitbucket.org/snippets/learndash/MK6Rp/learndash-add-new-user-to-group)

learndash_set_users_group_ids( $user_id, $learndash_group_ids );
}

}
?>
