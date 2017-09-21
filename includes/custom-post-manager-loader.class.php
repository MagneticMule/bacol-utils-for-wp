<?php

class CustomPostManager {

  /**
   * The array of screen names that the custom widgets will appear on.
   */
  protected $screens;

  /**
   * Default constructor. Initialises any member variables and sets the screen type.
   * @$screens defaults to 'playscripts' however
   */
  public function __construct( $s = array ( 'playscripts' ) )
  {
    $this->screens = $s;
  }


  /**
    * Remove the "Add Featured Image" meta box in the new Activity page. We still need the post thumbnail capability under the hood.
    * @return [null] [no return type]
   */
  public function hideMetaBoxes()
  {
    remove_meta_box( 'pageparentdiv', 'playscripts', 'side' );
    // for some odd reason this doesn't always work. Very annoying.
    remove_meta_box( 'postimagediv', 'playscripts', 'side' );
  }

  public function hideControlls() {
    remove_action( 'media_buttons', 'media_buttons');
  }


  /**
   * Defines an array of labels to pass to the
   * ref: https://codex.wordpress.org/Function_Reference/register_post_type.
  **/
  function buildCustomPostWidgets()
  {
    // add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
    add_meta_box( 'cover_image_meta_box', 'Add an Image', array($this,'selectImageMetaBox'), 'playscripts', 'normal', 'high' );
    add_meta_box( 'cover_sound_meta_box', 'Add a Sound', array($this,'selectSoundMetaBox'), 'playscripts', 'normal', 'high' );
  }


  /**
   * Use the first image from the post as the 'featured' image.
   */
  public function setFeaturedImage()
  {

    $featuredImage = get_post_custom_values( 'no_featured_image', get_the_id() );
    if (empty($featuredImage[0]) ){

    }
  }

  /**
    *
    * @return none
    * @todo Separate the upload feature from select from gallery.
    */
  public function selectImageMetaBox( )
  {
    // does the post already have an associated image? If not, then display the option to select one.
    if(!(has_post_thumbnail( get_the_id() ))) {
      echo '<a href="#">Select an image from the gallery</a> or <a href="#">upload one of your own</a>.</p>';
    }
    // if the post does have a cover image then display a 300x300 thumbnail of it.
    else {
      the_post_thumbnail( 'medium'); //
    }
    // echo '<p><button type="button">Add a New Image</button></p>';
    // echo '<a title="Set featured image" href="#" id="set-post-thumbnail" class="thickbox">Set featured image</a>';
  }

 /**
  *
  * @return [type] [description]
  */
 public function selectSoundMetaBox( $post )
 {
  echo '<p>Select a sound from the gallery or upload one of your own.</p>';
  echo '<p><button type="button">Add a New Sound</button></p>';
}

 /**
  * We need to reassign the first posted image to be the featured image.
  * @return null
  */
 public function reassignFeaturedImage()
 {

 }

  /**
   * Entry point for the class.
   * @return none
   */
  public function registerCustomPost()
  {
    // add_action('do_meta_boxes', array($this,'hideMetaBoxes' ));
    // add_action('admin_head', array($this,'hideControlls' ));
    add_action('admin_init', array($this, 'buildCustomPostWidgets'));
    add_action('the_post', array($this, 'setFeaturedImage' ));
    add_action('save_post', array($this, 'setFeaturedImage' ));
    // add_action('draft_to_publish', array($this, 'setFeaturedImage' ));
  }


}