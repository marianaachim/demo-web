<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

// Disable gutenberg

add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// add bootstrap

function your_theme_enqueue_scripts() {
    // all styles
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), 20141119 );
    // all scripts
    wp_enqueue_script('my_script', get_stylesheet_directory_uri() .'/js/jquery.js');
    wp_enqueue_script('my_script2', get_stylesheet_directory_uri() .'/js/js.js');
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true );

    wp_enqueue_script( 'theme-script', get_template_directory_uri() .'/js/scripts.js', array('jquery'), '20120206', true );

    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/js/scrollify.min.js', array( 'jquery' ), '1.0', true );


    
}
add_action( 'wp_enqueue_scripts', 'your_theme_enqueue_scripts' );






function wpb_hook_javascript() {
    ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha256-H3cjtrm/ztDeuhCN9I4yh4iN2Ybx/y1RM7rMmAesA0k=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollify/1.0.19/jquery.scrollify.min.js" integrity="sha256-RGlAwHKG24hsj1109SGQgvR+Orx7u8c6zyYH4Tk3ydU=" crossorigin="anonymous"></script>
    <?php
}
add_action('wp_head', 'wpb_hook_javascript');

/*
* Creating a function to create our partners
*/
 add_action( 'init', 'create_partners' );
function create_partners() { 
    // set up labels
    $labels = array(
        'name' => 'Partners',
        'singular_name' => 'Partner Item',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Partner Item',
        'edit_item' => 'Edit Partner Item',
        'new_item' => 'New Partner Item',
        'all_items' => 'All Partners',
        'view_item' => 'View Partner Item',
        'search_items' => 'Search Partners',
        'not_found' =>  'No Partners Found',
        'not_found_in_trash' => 'No Partners found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Partners',
    );
    register_post_type(
        'partners',
        array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => true,
            'supports' => array( 'title', 'editor', 'thumbnail','page-attributes' ),
            'taxonomies' => array( 'post_tag', 'category' ),
            'exclude_from_search' => true,
            'capability_type' => 'post',
        )
    );
}
 
// create shortcode to list all clothes which come in blue
add_shortcode( 'partners-list-shortcode', 'partners_listing_shortcode' );
function partners_listing_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'partners',
        'posts_per_page' => -1,
        'order' => 'ASC',
    ) );
    if ( $query->have_posts() ) { ?>
    <div class="partners-listing">
        <div class="container">
            <div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 image-pop" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                <?php $url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' ); ?>
                <?php if ($url) : ?>
                    <img class="img-responsive partners-img" src="<?php echo $url ?>" />
                <?php endif ?>
            </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

add_shortcode( 'resources-list-shortcode', 'resources_listing_shortcode' );
function resources_listing_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'resources',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby'=>'menu_order'
    ) );
    if ( $query->have_posts() ) { ?>
        <div class="resources-listing">
            <?php 
            $i = 0;
            ?>
            
            <!-- <div class="slider">
                <a class="item" href="#video">First</a>
                <a class="item" href="#content">Content</a>
                <a class="item" href="#partners">Partners</a>
                <a class="item"href="#contact">Contact</a>
            </div> -->

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

            <div class="resource-item panel"  data-panel="<?php echo $i?>">
                <?php $shortcode = get_post_meta( get_the_ID(), 'resources-shortcode' , true) ?>
                <?php $title = get_post_meta( get_the_ID(), 'resources-title' , true); ?>
                <?php $video = get_post_meta( get_the_ID(), 'resources-youtube' , true) ?>
                <?php $logo = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail', true ); ?>
                <?php $contact = get_post_meta( get_the_ID(), 'resources-contact' , true); ?>


                <?php if( $video && $logo ): ?>
                <div id="video post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="video-background">
                        <div class="video-foreground">
                            <iframe src="<?php echo $video ?>?controls=0&showinfo=0&rel=0&autoplay=1&loop=1" allow="autoplay" frameborder="0" allowfullscreen></iframe>
                            <img class="logo " src="<?php echo $logo?>" alt="logo">
                        </div>
                    </div>
                    <div class="bottom-scroll"><i class="fa-angle-double-down fas button-icon-left"></i><span class="scroll-button-text">Scroll</span></div>
                </div>
                <?php endif ?>

                <?php if($shortcode && $title):?>
                    <div id="partners post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="animatable">
                            <div class="content-partners"> 
                                <p class="title"><?php echo $title?></p>
                                <?php echo do_shortcode($shortcode)?>
                            </div>
                        </div>
                    </div>
                <?php endif?>

                <?php if($title && !$contact && !$shortcode): ?>
                    <div id="content post-<?php the_ID(); ?> " <?php post_class(); ?> >
                        <div class="animatable">
                            <p class="title"><?php echo $title?></p>
                        </div>
                    </div>
                <?php endif ?>

            
            <?php if($contact && $title):?>
                <div id="contact post-<?php the_ID(); ?> " <?php post_class(); ?> >
                    <div class="animatable">
                        <p class="title"><?php echo $title?></p>
                        <p class="email"><i class="fa fa-envelope" style="color: #ea5023;" aria-hidden="true"></i> <?php echo $contact?></p>
                    </div>
                </div>
            <?php endif ?>


             <?php $i++ ?>
            </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

/*
* Creating a function to create our homepage
*/
 add_action( 'init', 'homepage_resources' );
function homepage_resources() { 
    // set up labels
    $labels = array(
        'name' => 'Resources',
        'singular_name' => 'Resource Item',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New resource Item',
        'edit_item' => 'Edit resource Item',
        'new_item' => 'New resource Item',
        'all_items' => 'All Resources',
        'view_item' => 'View resource Item',
        'search_items' => 'Search Resources',
        'not_found' =>  'No Resources Found',
        'not_found_in_trash' => 'No Resources found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Resources',
    );
    register_post_type(
        'resources',
        array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
            'taxonomies' => array( 'post_tag', 'category' ),
            'exclude_from_search' => true,
            'capability_type' => 'post',
        )
    );
}

function resources_dates_metabox() {
    add_meta_box( 
        'resources_dates_metabox', 
        __( 'Resource Item', 'resources'), 
        'resources_dates_metabox_callback', 
        'resources', 
        'advanced', 
        'high'
    ); 
}
add_action( 'add_meta_boxes', 'resources_dates_metabox' );
function resources_dates_metabox_callback( $post ) { 

    wp_nonce_field( 'resources_dates_metabox_nonce', 'resources_dates_nonce' ); ?>

  <?php         
    $resource_title = get_post_meta( $post->ID, 'resources-title', true );
    $resource_youtube = get_post_meta( $post->ID, 'resources-youtube', true );
    $resource_shortcode = get_post_meta( $post->ID, 'resources-shortcode', true );    
    $resource_contact = get_post_meta( $post->ID, 'resources-contact', true );    
    
  ?>

  <p>   
    <label for="resources_title"><?php _e('Title', 'resources' ); ?></label><br/>    
    <input type="text" class="widefat" name="resources_title" value="<?php echo esc_attr( $resource_title ); ?>" />
  </p>

  <p>
  <label for="resources_youtube"><?php _e('Youtube Link', 'resources' ); ?></label><br/> 
  <input type="text" class="widefat" name="resources_youtube" value="<?php echo esc_attr( $resource_youtube ); ?>" />
  </p>   
  
  <p>   
    <label for="resources_shortcode"><?php _e('Shortcode', 'resources' ); ?></label><br/>    
    <input type="text" class="widefat" name="resources_shortcode" value="<?php echo esc_attr( $resource_shortcode ); ?>" />
  </p>

  <p>   
    <label for="resources_contact"><?php _e('Contact', 'resources' ); ?></label><br/>    
    <input type="text" class="widefat" name="resources_contact" value="<?php echo esc_attr( $resource_contact ); ?>" />
  </p>

<?php }


function resources_dates_save_meta( $post_id ) {

    if( !isset( $_POST['resources_dates_nonce'] ) || !wp_verify_nonce( $_POST['resources_dates_nonce'],'resources_dates_metabox_nonce') ) 
      return;
  
    if ( !current_user_can( 'edit_post', $post_id ))
      return;
  
    if ( isset($_POST['resources_title']) ) {        
      update_post_meta($post_id, 'resources-title', sanitize_text_field( $_POST['resources_title']));      
    }  
  
    if ( isset($_POST['resources_youtube']) ) {        
      update_post_meta($post_id, 'resources-youtube', sanitize_text_field( $_POST['resources_youtube'] ));      
    }

    if ( isset($_POST['resources_shortcode']) ) {        
      update_post_meta($post_id, 'resources-shortcode', sanitize_text_field( $_POST['resources_shortcode']));      
    }  

    if ( isset($_POST['resources_contact']) ) {        
      update_post_meta($post_id, 'resources-contact', sanitize_text_field( $_POST['resources_contact']));      
    }

    }
  add_action('save_post', 'resources_dates_save_meta');