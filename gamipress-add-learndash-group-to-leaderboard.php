<?php
/*
The below functions will add a custom column (Group) to GamiPress leaderboards on WordPress.

These functions only returns the first group they are part of, it will not bring in multiple groups, nor will it show groups which the user is a leader of.

See https://gamipress.com/snippets/gamipress-leaderboards/add-a-custom-column-to-the-leaderboard-table/ for GamiPress Reference
*/

function my_prefix_custom_leaderboard_column($columns, $leaderboard_id, $leaderboard)
	{
	// Add the new column
	// The key "my_custom_column" will be used to filter the column output in next function
	// The "Group" will be the column title
	$columns['my_custom_column'] = __('Group');
	return $columns;
	}
add_filter('gamipress_leaderboards_leaderboard_columns_info', 'my_prefix_custom_leaderboard_column', 10, 3);

function my_prefix_custom_leaderboard_column_output($output, $leaderboard_id, $position, $item, $column_name, $leaderboard_table)
	{

	// Loop through the items so we can get the group IDs for each user
	foreach($item as $items)
		{
		/*
		This query will return the meta_key for the group the user is a part of.
		NOTE: It only returns the first group they are part of, it will not bring in multiple groups, nor will it show groups which the user is a leader of.
		*/
		global $wpdb;
		$results = $wpdb->get_results("SELECT meta_key FROM {$wpdb->prefix}usermeta WHERE user_id = {$item['user_id']} AND meta_key LIKE '%learndash_group_users_%'");

		// We run a count on the result which tells us how many groups they are assigned to, we can then show different messages if they are part of multiple groups or not assigned to any.
		$countofgroups = count($results);

		// If user has 1 group assigned, we can display the group name.
		if ($countofgroups == 1)
			{

			// Loop through the results to output the title of the group
			foreach($results as $result)
				{
				// This strips out all characters apart from numbers, we can then use the numbers to query for the post name
				$groupid = preg_replace('[\D]', '', $result->meta_key);

				$getpost = get_post($groupid);
				
				return $getpost->post_title;
				}
			}
		// If user has more than 1 group assigned, display a message saying they are assigned to multiple groups
		elseif ($countofgroups > 1)
			{
			return "User assigned to multiple groups.";
			}
		// If user isn't asssigned to any groups, display the relevant message
		elseif ($countofgroups == 0)
			{
			return "No group assigned";
			}
		}
	}

// This filter dynamically changes based on the column key following the next pattern: gamipress_leaderboards_leaderboard_column_{key}
// In previous function the new column key is "my_custom_column", so the filter will be: gamipress_leaderboards_leaderboard_column_my_custom_column
add_filter('gamipress_leaderboards_leaderboard_column_my_custom_column', 'my_prefix_custom_leaderboard_column_output', 10, 6);
?>
