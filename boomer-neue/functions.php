<?php
/**
 * WP Bootstrap 4 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_4
 */


if ( ! function_exists( 'wp_bootstrap_4_setup' ) ) :
	function wp_bootstrap_4_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Enable Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'status', 'quote', 'link' ) );

		// Enable support for woocommerce.
		add_theme_support( 'woocommerce' );
		add_filter( 'woocommerce_show_variation_price', '__return_true' );

		add_action('get_header', 'remove_admin_login_header');
		function remove_admin_login_header() {
			remove_action('wp_head', '_admin_bar_bump_cb');
		}

		function lv2_add_bootstrap_input_classes( $args, $key, $value = null ) {
			/* This is not meant to be here, but it serves as a reference
			of what is possible to be changed.
			$defaults = array(
				'type'			  => 'text',
				'label'			 => '',
				'description'	   => '',
				'placeholder'	   => '',
				'maxlength'		 => false,
				'required'		  => false,
				'id'				=> $key,
				'class'			 => array(),
				'label_class'	   => array(),
				'input_class'	   => array(),
				'return'			=> false,
				'options'		   => array(),
				'custom_attributes' => array(),
				'validate'		  => array(),
				'default'		   => '',
			); */
			// Start field type switch case
			switch ( $args['type'] ) {
				case "select" :  /* Targets all select input type elements, except the country and state select input types */
					$args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
					$args['input_class'] = array('form-control', 'input-lg'); // Add a class to the form input itself
					//$args['custom_attributes']['data-plugin'] = 'select2';
					$args['label_class'] = array('control-label');
					$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
				break;
				case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
					$args['class'][] = 'form-group single-country';
					$args['label_class'] = array('control-label');
				break;
				case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
					$args['class'][] = 'form-group'; // Add class to the field's html element wrapper
					$args['input_class'] = array('form-control', 'input-lg'); // add class to the form input itself
					//$args['custom_attributes']['data-plugin'] = 'select2';
					$args['label_class'] = array('control-label');
					$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
				break;
				case "password" :
				case "text" :
				case "email" :
				case "tel" :
				case "number" :
					$args['class'][] = 'form-group';
					//$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
					$args['input_class'] = array('form-control', 'input-lg');
					$args['label_class'] = array('control-label');
				break;
				case 'textarea' :
					$args['input_class'] = array('form-control', 'input-lg');
					$args['label_class'] = array('control-label');
				break;
				case 'checkbox' :
				break;
				case 'radio' :
				break;
				default :
					$args['class'][] = 'form-group';
					$args['input_class'] = array('form-control', 'input-lg');
					$args['label_class'] = array('control-label');
				break;
			}
			return $args;
		}
		add_filter('woocommerce_form_field_args','lv2_add_bootstrap_input_classes',10,3);

		add_filter('woocommerce_form_field_args',  'wc_form_field_args',10,3);
		  function wc_form_field_args($args, $key, $value) {
		  $args['input_class'] = array( 'form-control' );
		  return $args;
		}

		remove_action ('wp_head', 'wp_site_icon', 99);


		// Update CSS within in Admin
		function admin_style() {
		  wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin.css');
		}
		add_action('admin_enqueue_scripts', 'admin_style');

		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
  	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
	  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);
	  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
	  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 5);
	  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 5);


		function cc_mime_types($mimes) {
		 $mimes['svg'] = 'image/svg+xml';
		 return $mimes;
		}
		add_filter('upload_mimes', 'cc_mime_types');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wp-bootstrap-4' ),
		) );

		// Switch default core markup for search form, comment form, and comments
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

	}
endif;
add_action( 'after_setup_theme', 'wp_bootstrap_4_setup' );


add_action( 'woocommerce_cart_actions', 'move_proceed_button' );
function move_proceed_button( $checkout ) {
	echo '<a href="' . esc_url(wc_get_checkout_url() ) . '" class="checkout-button button alt wc-forward greenbutton" >' . __( 'Proceed to Checkout', 'woocommerce' ) . '</a>';
}

add_action( 'woocommerce_before_add_to_cart_quantity', 'func_option_valgt' );
function func_option_valgt() {
    global $product;

    if ( $product->is_type('variable') ) {
        $variations_data =[]; // Initializing

        // Loop through variations data
        foreach($product->get_available_variations() as $variation ) {
            // Set for each variation ID the corresponding price in the data array (to be used in jQuery)
            $variations_data[$variation['variation_id']] = array($variation['display_price'],$variation['image']['full_src']);
        }


				foreach($product->get_available_variations() as $variation ) {
					$var_id = $variation['variation_id'];
					$var_image = $variation['image']['full_src'];
					?>
					<script> var p</script>
					<?php } ?>


        <script>
        jQuery(function($) {
            var jsonData = <?php echo json_encode($variations_data); ?>,

                inputVID = 'input.variation_id';
            $('input').change( function(){
                if( '' != $(inputVID).val() ) {
                    var vid      = $(inputVID).val(), // VARIATION ID
                        length   = $('#cfwc-title-field').val(), // LENGTH
                        diameter = $('#diameter').val(),  // DIAMETER
                        vprice   = ''; // Initilizing

                    // Loop through variation IDs / Prices pairs
                    $.each( jsonData, function( index, data ) {
                        if( index == $(inputVID).val() ) {
                            vprice = data[0]; // The right variation price
														vimage = data[1];
														console.log(vimage);
                        }
                    });
                    jQuery('.price_changer').text(vprice.toFixed(2));
										jQuery('.productPage__image__wrap>img').attr('src', vimage);
										jQuery('.productPage__image__wrap>img').attr('srcset', vimage);
                }
            });
        });
        </script>
        <?php
    }
}








function variation_radio_buttons($html, $args) {
  $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
    'options'          => false,
    'attribute'        => false,
    'product'          => false,
    'selected'         => false,
    'name'             => '',
    'id'               => '',
    'class'            => '',
    'show_option_none' => __('Choose an option', 'woocommerce'),
 ));

  if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
    $selected_key     = 'attribute_'.sanitize_title($args['attribute']);
    $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
  }

  $options               = $args['options'];
  $product               = $args['product'];
  $attribute             = $args['attribute'];
  $name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
  $id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
  $class                 = $args['class'];
  $show_option_none      = (bool)$args['show_option_none'];
  $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');

  if(empty($options) && !empty($product) && !empty($attribute)) {
    $attributes = $product->get_variation_attributes();
    $options    = $attributes[$attribute];
  }

  $radios = '<div class="variation-radios">';

  if(!empty($options)) {
    if($product && taxonomy_exists($attribute)) {
      $terms = wc_get_product_terms($product->get_id(), $attribute, array(
        'fields' => 'all',
      ));

      foreach($terms as $term) {
        if(in_array($term->slug, $options, true)) {
          $radios .= '<input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><label for="'.esc_attr($term->slug).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'</label>';
        }
      }
    } else {

      foreach($options as $option) {
			  $checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
        $radios    .= '<input  type="radio" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.' "><label for="'.sanitize_title($option).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</label>';
      }
    }
  }

  $radios .= '</div>';

  return $html.$radios;
}
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);


		add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
		function wc_refresh_mini_cart_count($fragments){
		    ob_start();
		    ?>
		    <div id="mini-cart-count">
		        <?php echo WC()->cart->get_cart_contents_count(); ?>
		    </div>
		    <?php
		        $fragments['#mini-cart-count'] = ob_get_clean();
		    return $fragments;
		}


				add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_price');
				function wc_refresh_mini_cart_price($fragments){
				    ob_start();
				    ?>
				    <div id="basket__totals__price">
				        <?php echo WC()->cart->get_cart_total(); ?>
				    </div>
				    <?php
				        $fragments['#basket__totals__price'] = ob_get_clean();
				    return $fragments;
				}


    add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );

    function bbloomer_display_quantity_plus() {
       echo '<button type="button" class="plus quantity__button">+</button></div>';
    }

    add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );

    function bbloomer_display_quantity_minus() {
       echo '<div class="quantity__wrap"><button type="button" class="minus quantity__button" >-</button>';
    }


    function add_theme_scripts()
    {
        wp_enqueue_style('style', get_stylesheet_uri());

				wp_enqueue_style('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.1', 'all');

        wp_enqueue_style('indexs', get_template_directory_uri() . '/assets/index.css', array(), '1.1', 'all');

        wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/index.js', array(
            'jquery'
        ), 1.1, true);

    }
    add_action('wp_enqueue_scripts', 'add_theme_scripts');


		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page();

		}



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_4_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_4_content_width', 800 );
}
add_action( 'after_setup_theme', 'wp_bootstrap_4_content_width', 0 );




/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_4_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-4' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<section id="%1$s" class="widget border-bottom %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'wp-bootstrap-4' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'wp-bootstrap-4' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'wp-bootstrap-4' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'wp-bootstrap-4' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<section id="%1$s" class="widget wp-bp-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title h6">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'wp_bootstrap_4_widgets_init' );




/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_4_scripts() {
	wp_enqueue_style( 'open-iconic-bootstrap', get_template_directory_uri() . '/assets/css/open-iconic-bootstrap.css', array(), 'v4.0.0', 'all' );
//	wp_enqueue_style( 'bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), 'v4.0.0', 'all' );
//	wp_enqueue_style( 'wp-bootstrap-4-style', get_stylesheet_uri(), array(), '1.0.2', 'all' );

	wp_enqueue_script( 'bootstrap-4-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), 'v4.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_4_scripts' );


/**
 * Registers an editor stylesheet for the theme.
 */
function wp_bootstrap_4_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'wp_bootstrap_4_add_editor_styles' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
