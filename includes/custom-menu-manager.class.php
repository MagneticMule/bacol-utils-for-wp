<?php

class MenuCustomizer {

    public function __construct() {}



    /**
     * Remove menu item from the admin menu using the menu's php class file.
     * What will be hidden can depend on the user role.
     * documentation : https://codex.wordpress.org/Function_Reference/remove_menu_page
     * @return null
     */
    public function removeMenuItems()
    {
        // assign the current user to the $user variable
        $user = wp_get_current_user();

        // check if the users 'roles' array contains the custom role 'researcher'.
        // If it does then we can remove the innappopriate sections from the admin menu.
        if( in_array ( 'researcher', (array) $user->roles ) ) {
            // remove_menu_page( 'index.php' );                  //Dashboard
            // remove_menu_page( 'edit.php' );                      //Posts
            // remove_menu_page( 'upload.php' );                 //Media
            // remove_menu_page( 'edit.php?post_type=page' );    //Pages
            // remove_menu_page( 'edit-comments.php' );          //Comments
            remove_menu_page( 'themes.php' );                 //Appearance
            remove_menu_page( 'plugins.php' );                //Plugins
            remove_menu_page( 'users.php' );                  //Users
            // remove_menu_page( 'tools.php' );                  //Tools
            remove_menu_page( 'options-general.php' );        //Settings

        } elseif ( in_array ( 'teacher', (array) $user->roles ) ) {
            // remove_menu_page( 'index.php' );                  //Dashboard
            // remove_menu_page( 'edit.php' );                      //Posts
            // remove_menu_page( 'upload.php' );                 //Media
            // remove_menu_page( 'edit.php?post_type=page' );    //Pages
            // remove_menu_page( 'edit-comments.php' );          //Comments
            remove_menu_page( 'themes.php' );                 //Appearance
            remove_menu_page( 'plugins.php' );                //Plugins
            remove_menu_page( 'users.php' );                  //Users
            // remove_menu_page( 'tools.php' );                  //Tools
            remove_menu_page( 'options-general.php' );        //Settings

        } elseif ( in_array( 'student',  (array) $user->roles ) ) {
            // remove_menu_page( 'index.php' );                  //Dashboard
            // remove_menu_page( 'edit.php' );                      //Posts
            // remove_menu_page( 'upload.php' );                 //Media
            remove_menu_page( 'edit.php?post_type=page' );    //Pages
            remove_menu_page( 'edit-comments.php' );          //Comments
            remove_menu_page( 'themes.php' );                 //Appearance
            remove_menu_page( 'plugins.php' );                //Plugins
            remove_menu_page( 'users.php' );                  //Users
            remove_menu_page( 'tools.php' );                  //Tools
            remove_menu_page( 'options-general.php' );        //Settings
        }
    }



    /**
     * Entry point for the class. Add the @removeMenuItems() method to the 'admin_menu' call
     * @return null
     */
    public function modifyAdminMenu()
    {
        add_action('admin_menu', array($this, 'removeMenuItems'));
    }

}