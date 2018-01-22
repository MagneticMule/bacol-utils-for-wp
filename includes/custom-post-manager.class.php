<?php

/**
 * Defines and created the custom post object for Building a City of Literature
 *
 * @author Thomas Sweeney <magneticmule@gmail.com>
 *
 */


class PostManager {

    /**
     * The custom taxonomy for this post object. Within the context of
     * Wordpress, a taxonomy is a way to group things together. Within the context of
     * (this custom post object, a taxonomy will allow us to group together
     *
     * @link(https://codex.wordpress.org/Taxonomies)
     * @var array
    **/
    private $taxonomy;

    /**
     * An array of labels for this post type. By default, post labels are used for non-hierarchical post types and page labels for hierarchical ones.
     * if empty, 'name' is set to value of 'label', and 'singular_name' is set to value of 'name'.
     *
     * @var array
     */
    private $labels;

    /**
     * Tag identifier used by file includes and selector attributes.
     *
     * @var string
     */
    protected $tag = 'PostManager';

    /**
     * Friendly name used to identify the plugin.
     *
     * @var string
     */
    protected $name = 'postutils';

    /**
     * Current version of the plugin.
     *
     * @var string
     */
    protected $version = '0.1.1';

    /**
     * Default Constructor.
     */
    public function __construct()
    {
        $this->taxonomy = array();
        $this->labels   = array();
    }

    /**
     * Rename the standard blog admin area from "Posts to " Group Blog".
     * 
     */
    function changePostLabel()
    {
        global $menu;
        global $submenu;
        $menu[5][0] = 'News';
        $submenu['edit.php'][5][0] = 'Grou Blog';
        $submenu['edit.php'][10][0] = 'Add Post';
        $submenu['edit.php'][16][0] = 'Post Tags';
    }
    function changePostObject()
    {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Blog Post';
        $labels->singular_name = 'Blog Post';
        $labels->add_new = 'Add Blog Post';
        $labels->add_new_item = 'Add Blog post';
        $labels->edit_item = 'Edit Blog post';
        $labels->new_item = 'Blog Post';
        $labels->view_item = 'View Blog Posts';
        $labels->search_items = 'Search Blog Posts';
        $labels->not_found = 'No Blog Posts found';
        $labels->not_found_in_trash = 'No Blog Posts found in Trash';
        $labels->all_items = 'All Blog Posts';
        $labels->menu_name = 'Blog Post';
        $labels->name_admin_bar = 'Group Blog';
    }

    /**
     * Our taxonomy will include classes that students
     * can be part of as well as activities that students can participate in.
     */
    public function buildPlayScriptTaxonomy()
    {
        register_taxonomy(
            'classes',
            'scripts',
            array(
                'hierarchical' => true,
                'label' => 'Scripts',
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'classes',
                    'with_front' => true,
                    ),
                )
            );
    }

     /**
      * Defines an array of labels to pass to the custom post type
      *
      * @see register_post_type()
      * @link https://codex.wordpress.org/Function_Reference/register_post_type. 
      */
     public function buildPlayScriptPost()
     {
         $labels = array(
            'name' => __( 'Play Scripts' ),
            'singular_name' => __( 'Play Script' ),
            'add_new' => ( 'Add New' ),
            'add_new_item' => ( 'Add New Play Script' ),
            'edit_item' => ( 'Edit Play Script' ),
            'new_item' => ( 'New Play Script' ),
            'view_item' => ( 'View Play Script' ),
            'not_found' => ( 'No Play Scripts found' ),
            'not_found_in_trash' => ( 'No Play Scripts found in Trash' ),
            'parent_item_colon' => ( 'Parent Play Script:' ),
            'menu_name' => ( 'Play Scripts' ),
            );

         $customPostArgs = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'Play Scripts',
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes' ),
            'taxonomies' => array( 'classes' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 1,
            'menu_icon' => 'dashicons-format-aside',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'rewrite' => array( 'slug' => 'playscripts' )
            );

         register_post_type( 'playscripts', $customPostArgs );
     }

    /**
     * [addPostToQuery description]
     * @param [type] $query [description]
     */
    function addPostToQuery($query) {
        if( is_home() && $query->is_main_query() )
        {
            $query->set( 'playscripts', 'post' );
        }
        return $query;
    }

    /**
     * The 'register_post_type' function needs to be called during the WP init phase of execution.
     * note, when using this in a class based plugin we need to define the callback class 
     * "which is always $this" as the first element of an array.
     * @return null
     */
    public function registerPostManager()
    {
        add_action('init', array($this, ''))
        add_action( 'init', array($this, 'buildPlayScriptPost' ));
        add_action( 'init', array($this, 'buildPlayScriptTaxonomy' ));
    }
}
