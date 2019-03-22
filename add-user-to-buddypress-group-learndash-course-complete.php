<?php

add_action("learndash_course_completed", function($data) {

	// Gets the user ID of the user who completed the course	
	$user_id = $data['user']->ID;
	
	// Gets the Course ID so we can add users to specific groups based on the course
	$CourseID = $data['course']->ID;

	
    // Replace 1167 with the course ID you want to target, this ensures the user is only added to the Buddypress group when they complete the specific course of your choosing
    if ($CourseID == 1167){
	
	    // Replace 11 with the ID of the Buddypress group you want to add the learner to. If you want to add them to multiple groups simply add a , between the number E.G 11,15,19
	    $group_id = array(11);

	// Loop through the groups and accept the invite on behalf of the user - this is where the user is added to the group as a memeber
        foreach ($group_id as $groupid){
            groups_accept_invite( $user_id, $groupid );
        }

    }
}, 5, 1);

?>
