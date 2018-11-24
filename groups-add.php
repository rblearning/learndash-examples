<?php
// Adds users registered via gravity forms to learndash groups

add_action( 'gform_user_registered', 'add_to_learndash_groups', 10, 4 );
function add_to_learndash_groups( $user_id, $feed, $entry ){

// Replace 1180 and 2288 with the IDs of the groups you want to add new users to
$learndash_group_ids = array( 1180, 2288 );

// adds the users to the groups (https://bitbucket.org/snippets/learndash/MK6Rp/learndash-add-new-user-to-group)
learndash_set_users_group_ids( $user_id, $learndash_group_ids );
?>
