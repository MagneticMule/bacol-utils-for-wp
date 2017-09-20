<?php

class RolesManager {

	public function __construct() {}

	/*
	public function changeRoleNames()
	{
		global $wp_roles;
		if ( ! isset( $wp_roles )) {
			$wp_roles = new WP_Roles();
			$wp_roles->roles['editor']['name'] = 'Researcher';
			$wp_roles->role_names['editor'] = 'Researcher';
			$wp_roles->roles['author']['name'] = 'Teacher';
			$wp_roles->role_names['a,uthor'] = 'Teacher';
			$wp_roles->roles['subsciber']['name'] = 'Student';
			$wp_roles->role_names['subsciber'] = 'Student';
		}
	}
	*/

	/**
	* Add new roles pecific to the BACOL project
	*
	*/
	public function addNewRoles()
	{
		$wp_roles = new WP_Roles();

		// student role assigned to students in each of the schools
		$wp_roles->add_role( 'student', 'Student', array(
			'read' => true,
			'create_posts' => true,
			'publish_posts' => true,
			'edit_posts' => true,
			'edit_published_pages' => true,
			'edit_published_posts' => true,
			'delete_posts' => false,
		)
		);

		$wp_roles->add_role( 'teacher', 'Teacher', array(
			'read' => true,
			'create_posts' => true,
			'publish_posts' => true,
			'edit_posts' => true,
			'edit_published_pages' => true,
			'edit_published_posts' => true,
			'delete_posts' => true,
		)
		);

		$wp_roles->add_role( 'researcher', 'Researcher', array(
			'read' => true,
			'create_posts' => true,
			'publish_posts' => true,
			'edit_posts' => true,
			'edit_published_pages' => true,
			'edit_published_posts' => true,
			'delete_posts' => true,
		)
		);
	}

	/**
	 * Entry point to class.
	 *
	 */
	public function registerRoles()
	{
		add_action('init', array($this, 'addNewRoles'));
	}

}