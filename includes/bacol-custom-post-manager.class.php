<?php

/**
 * Defines and created the custom post object for youlisten.media
 *
 * @author Thomas Sweeney <magneticmule@gmail.com>
 *
 */


class BacolPostManager {

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
    protected $tag = 'BacolPostManager';

    /**
     * Friendly name used to identify the plugin.
     *
     * @var string
     */
    protected $name = 'bacolpost';

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
     * Our taxonomy will include classes that students
     * can be part of as well as activities that students can participate in.
     */
    public function buildCustomTaxonomy()
    {
        register_taxonomy(
            'classes',
            'scripts',
            array(
                'hierarchical' => true,
                'label' => 'Classes',
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
      * @see https://codex.wordpress.org/Function_Reference/register_post_type.
      **/
     public function buildCustomPost()
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
            'description' => 'Play Scripts filterable by Student class',
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes' ),
            'taxonomies' => array( 'classes' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 1,
            'menu_icon' => 'dashicons-admin-post',
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

         register_post_type( 'play_scripts', $customPostArgs );
     }

    /**
     * [addPostToQuery description]
     * @param [type] $query [description]
     */
    function addPostToQuery($query) {
        if( is_home() && $query->is_main_query() )
        {
            $query->set( 'play_scripts', 'page' );
        }
        return $query;
    }


    /**
     * The 'register_post_type' function needs to be called during the WP init phase of execution.
     * note, when using this in a class based plugin we need to define the callback class "which is always $this" via an array.
     **/
    public function registerPostManager()
    {
        // $this->taxonomy =
        add_action( 'init', array($this, 'buildCustomPost' ));
        add_action( 'init', array($this, 'buildCustomTaxonomy' ));
    }
}
