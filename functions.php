<?php
/**
 * Hypermarket Child functions and definitions
 *
 * For more information on hooks, actions, and filters,
 *
 * @see 		https://codex.wordpress.org/Theme_Development
 * @see 		https://codex.wordpress.org/Child_Themes
 * @see 		https://codex.wordpress.org/Plugin_API
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket Child
 * @since 		1.0.6
 */
if (!defined('ABSPATH')):
	exit;
endif;

if (!class_exists('Hypermarket_Child')):
	/**
	 * The setup Hypermarket Child class
	 */
	class Hypermarket_Child

	{
		private $parent_public_assets_url;
		private $child_public_assets_url;
		/**
		 * Setup class.
		 *
		 * @since 1.0.1
		 */
		public function __construct()

		{
			$this->parent_public_assets_url = esc_url(get_template_directory_uri() . '/assets/');
			$this->child_public_assets_url = esc_url(get_stylesheet_directory_uri() . '/assets/');
			add_action('after_setup_theme', array(
				$this,
				'setup'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue_child'
			) , 99);
			
			add_action( 'init' , array(
				$this, 
				'zafirah_add_and_remove'
			), 15);
			
			add_action( 'wp_footer', array(
				$this, 
				'zafirah_scripts_css'
			));
			//add_action( 'widgets_init', array($this, 'zafirah_widgets_init' ));
			add_filter('show_admin_bar', '__return_false');
									
			add_filter('script_loader_tag', array($this, 'add_async_attribute'), 10, 2);
			
			add_action( 'hypermarket_homepage_template', array($this, 'hypermarket_homepage_content_slider'), 0 );
			add_action('hypermarket_before_header_area', array($this, 'zafirah_top_bar'), 1);
			add_action('hypermarket_before_header_area', array($this, 'hypermarket_page_loader'), 2);
			
			// HTML Compression
			// https://gist.github.com/sethbergman/d07e879200bef6862131
			//add_action('get_header', 'wp_html_compression_start');
			
			//add_action('fw_ext_shortcodes_enqueue_static:text_block', array(
			//	$this, 
			//	'zafirah_shortcode_text_block_css'
			//));
			
			// CSS Compression
			//add_action('wp_footer', array($this, 'zafirah_css_compression'));
			add_filter( 'woocommerce_checkout_fields' , array($this, 'custom_override_checkout_fields' ));
		}
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.6
		 */
		public function setup()

		{	
			/**
			 *  Declare textdomain for this child theme.
			 *  Translations can be added to the /languages/ directory.
			 */
			load_child_theme_textdomain('hypermarket-child', get_stylesheet_directory() . '/languages');
			/**
			 *  This theme styles the visual editor to resemble the theme style,
			 *  specifically font, colors, icons, and column width.
			 */
			add_editor_style( array( $this->child_public_assets_url . '/css/editor-style.css', add_query_arg(apply_filters('hypermarket_child_default_font_family', array(
				'family' => urlencode('Work Sans:400,300,500,600'),
				'subset' => urlencode('latin,latin-ext')
			)) , 'https://fonts.googleapis.com/css')));
			
			
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.5
		 */
		public function enqueue()

		{	
			wp_enqueue_style('hypermarket-critical-styles', $this->parent_public_assets_url . '/css/hypermarket-critical.css', HYPERMARKET_THEME_VERSION);
			//wp_enqueue_style('hypermarket-styles', $this->parent_public_assets_url . '/css/hypermarket.css', HYPERMARKET_THEME_VERSION);
			
			if (is_rtl()):
				wp_enqueue_style('hypermarket-rtl-styles', get_template_directory_uri() . '/rtl.css', HYPERMARKET_THEME_VERSION);
			endif;
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.5
		 */
		public function enqueue_child()

		{
			wp_dequeue_style('hypermarket-font');
			wp_dequeue_style( 'follow-up-emails' );
			wp_dequeue_style( 'aws-style' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'tinvwl' );
			wp_dequeue_style( 'fw-ext-builder-frontend-grid' );
			wp_dequeue_style( 'fw-ext-forms-default-styles' );
			wp_dequeue_style( 'thickbox' );
			wp_dequeue_style( 'the_champ_frontend_css' );
			wp_dequeue_style( 'fw-shortcode-section-background-video' );
			wp_dequeue_style( 'fw-shortcode-section' );
			wp_dequeue_style( 'font-awesome' );
			wp_dequeue_style( 'fw-shortcode-icon' );
			
			wp_dequeue_style( 'pwp-style' );
			
			wp_dequeue_style( 'hypermarket-child-style' );
			
			if( is_woocommerce() || is_cart() || is_checkout() ):
				wp_enqueue_style('zafirah-woo', $this->child_public_assets_url . '/css/woocommerce.css', HYPERMARKET_THEME_VERSION);
			endif;
			
			
			
			wp_enqueue_style('zafirah-critical', $this->child_public_assets_url . '/css/critical.css', HYPERMARKET_THEME_VERSION);
			
			if(is_home() || is_front_page()):
				
			//	wp_enqueue_style( 'zafirah-home', $this->child_public_assets_url . '/css/home/main.css', HYPERMARKET_THEME_VERSION );
				
				wp_enqueue_style( 'zafirah-swiper-style', $this->child_public_assets_url . '/swiper/dist/css/swiper.min.css', HYPERMARKET_THEME_VERSION );
				wp_enqueue_script( 'zafirah-swiper-script', $this->child_public_assets_url . '/swiper/dist/js/swiper.min.js', array('jquery'), HYPERMARKET_THEME_VERSION, true );
				wp_enqueue_script('swiper-custom', $this->child_public_assets_url . '/js/swiper-custom.js', array('jquery'), HYPERMARKET_THEME_VERSION, true);
			endif;
			
			
			
			if(is_page('my-account')):
				wp_enqueue_style('zafirah-account', $this->child_public_assets_url . '/css/my-account.css', HYPERMARKET_THEME_VERSION);
				wp_enqueue_script('zafirah-account', $this->child_public_assets_url . '/js/my-account.js', array('jquery'), HYPERMARKET_THEME_VERSION, true);
			
			elseif( is_checkout() ):
				wp_enqueue_style('zafirah-checkout', $this->child_public_assets_url . '/css/checkout.css', HYPERMARKET_THEME_VERSION);
				wp_enqueue_script('zafirah-account', $this->child_public_assets_url . '/js/my-account.js', array('jquery'), HYPERMARKET_THEME_VERSION, true);
							
			else:
				wp_enqueue_script('critical', $this->child_public_assets_url . '/js/critical.js', array('jquery'), HYPERMARKET_THEME_VERSION, false);
			endif;
			
			
			
			
			//wp_enqueue_style('zafirah-font', add_query_arg(apply_filters('hypermarket_default_font_family', array(
			//	'family' => urlencode('Montserrat:300,400,500,600'),
			//	'subset' => urlencode('latin,latin-ext')
			//)) , 'https://fonts.googleapis.com/css') , array() , HYPERMARKET_THEME_VERSION);
			
			
		}
		
		public function zafirah_add_and_remove() {
			
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
			remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			
			//remove_action('hypermarket_homepage_template', 'hypermarket_homepage_content', 40);
			//add_action( 'hypermarket_homepage_template', 'hypermarket_homepage_content', 0 );
			remove_filter( 'hypermarket_homepage_page_title', 'hypermarket_homepage_page_title' );
		}
		
		
		
		public function zafirah_scripts_css(){
			
			wp_enqueue_script('zafirah-lazysizes-scripts', $this->child_public_assets_url . '/js/lazysizes.min.js', array(
				'jquery',
				'hypermarket-scripts'
			) , HYPERMARKET_THEME_VERSION, true);
							
			
			//wp_enqueue_style('follow-up-emails', plugins_url() . '/woocommerce-follow-up-emails/templates/followups.css', HYPERMARKET_THEME_VERSION);
			wp_enqueue_style('aws-style', plugins_url() . '/advanced-woo-search/assets/css/common.css', HYPERMARKET_THEME_VERSION);
			//wp_enqueue_style('woocommerce_prettyPhoto_css', plugins_url() . '/woocommerce/assets/css/prettyPhoto.css', HYPERMARKET_THEME_VERSION);
			
			if(is_page('wishlist') || is_home() || is_front_page() || is_woocommerce()):
				wp_enqueue_style('tinvwl', plugins_url() . '/ti-woocommerce-wishlist/assets/css/public.min.css', HYPERMARKET_THEME_VERSION);
			endif;
			
			//wp_enqueue_style('fw-ext-builder-frontend-grid', plugins_url() . '/unyson/framework/extensions/builder/static/css/frontend-grid.css', HYPERMARKET_THEME_VERSION, 'print');
			
			//wp_enqueue_style('fw-ext-forms-default-styles', plugins_url() . '/unyson/framework/extensions/forms/static/css/frontend.css', HYPERMARKET_THEME_VERSION);
			//wp_enqueue_style('the_champ_frontend_css', plugins_url() . '/super-socializer/css/front.css', HYPERMARKET_THEME_VERSION);
			//wp_enqueue_style('fw-shortcode-section-background-video', plugins_url() . '/unyson/framework/extensions/shortcodes/shortcodes/section/static/css/background.css', HYPERMARKET_THEME_VERSION);
			//wp_enqueue_style('fw-shortcode-section', plugins_url() . '/unyson/framework/extensions/shortcodes/shortcodes/section/static/css/styles.css', HYPERMARKET_THEME_VERSION);
			
			//wp_enqueue_style('font-awesome', plugins_url() . '/unyson/framework/static/libs/font-awesome/css/font-awesome.min.css', HYPERMARKET_THEME_VERSION);
			//wp_enqueue_style('fw-shortcode-icon', plugins_url() . '/unyson/framework/extensions/shortcodes/shortcodes/icon/static/css/styles.css', HYPERMARKET_THEME_VERSION);
			
			wp_enqueue_style('pwp-style', plugins_url() . '/progressive-wp/assets/styles/ui.css', HYPERMARKET_THEME_VERSION);
			
			wp_enqueue_style('hypermarket-noncritical', $this->parent_public_assets_url . '/css/hypermarket-noncritical.css', HYPERMARKET_THEME_VERSION);
			
			wp_enqueue_style( 'hypermarket-child-style' );
			
			wp_enqueue_style('zafirah-child-styles', $this->child_public_assets_url . '/css/hypermarket-child.css', HYPERMARKET_THEME_VERSION);
			
			wp_enqueue_script('zafirah-child-scripts', $this->child_public_assets_url . '/js/hypermarket-child.js', array(
				'jquery',
				'hypermarket-scripts'
			) , HYPERMARKET_THEME_VERSION, true);
			
		}
		
		
		/**
		* add the async to the lazysizes script
		*/
		
		public function add_async_attribute($tag, $handle) {
		    if ( 'zafirah-lazysizes-scripts' !== $handle )
		        return $tag;
		    return str_replace( ' src', ' async="async" src', $tag );
		}
		
		/**
		 * Top Bar.
		 *
		 * @package Hooked into "frontlash_before_header_area"
		 * @since 1.0.0
		 */
		public function zafirah_top_bar(){
			get_template_part('template-parts/top-bar');
		}
		
		/**
		 * Page Loader.
		 *
		 * @package Hooked into "frontlash_before_header_area"
		 * @since 1.0.0
		 */
		public function hypermarket_page_loader(){
			get_template_part('template-parts/page-loader');
		}
		
		/**
		 * Homepage slider.
		 *
		 * @package Hooked into "hypermarket_homepage_template"
		 * @since 1.0.0
		 */
		
		public function hypermarket_homepage_content_slider(){
			get_template_part('template-parts/hypermarket-homepage-slider');
		}

		
		
		public function zafirah_shortcode_text_block_css ($data) {
			$atts = zafirah_shortcode_options($data,'text-block'); 
			
			ob_start(); 
			
			if( ( isset($atts['margin']) && $atts['margin'] ) || 
					  ( isset($atts['background_color']) && $atts['background_color'] ) ||
					  ( isset($atts['padding']) && $atts['padding'] ) ) : ?>
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> {
					<?php if( $atts['margin'] ) : ?>
						margin: <?php echo esc_attr( $atts['margin'] ); ?>;
					<?php endif; ?>
					<?php if( $atts['padding'] ) : ?>
						padding: <?php echo esc_attr( $atts['padding'] ); ?>;
					<?php endif; ?>
					<?php if( $atts['background_color'] ) : ?>
						background-color: <?php echo esc_attr( $atts['background_color'] ); ?>;
					<?php endif; ?>
				}
				
				@media screen and (max-width: 767px) {
					#text-block-<?php echo esc_attr( $atts['id'] ); ?> {
						<?php if( $atts['margin'] ) : ?>
							margin: 0;
						<?php endif; ?>
						<?php if( $atts['padding'] ) : ?>
							padding: 0;
						<?php endif; ?>
					}
				}
				
			<?php endif; ?>
			
			<?php if( ( isset($atts['line_height']) && $atts['line_height'] ) ) : ?>
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> li,
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> p,
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> {
					line-height: <?php echo esc_attr( $atts['line_height'] ); ?>;
				}
			<?php endif;
			
			if( ( isset($atts['text_size']) && $atts['text_size'] ) ||
				( isset($atts['text_color']) && $atts['text_color'] ) ||
				( isset($atts['text_weight']) && $atts['text_weight'] )) : ?>
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> p,
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> li,
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> a{
					<?php if( $atts['text_color'] ) : ?>
						color: <?php echo esc_attr( $atts['text_color'] ); ?>;
					<?php endif;?>
					<?php if( $atts['text_size'] ) : ?>
						font-size: <?php echo esc_attr( $atts['text_size'] ); ?>;
					<?php endif;?>
					<?php if( $atts['text_weight'] ) : ?>
						font-weight: <?php echo esc_attr( $atts['text_weight'] ); ?>;
					<?php endif;?>
				}
			<?php endif;
			if( ( isset($atts['line_height']) && $atts['line_height'] ) ) : ?>
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> li{
					list-style-type: none;
					line-height: <?php echo esc_attr( $atts['line_height'] ); ?>;
				}
			<?php endif;
			if( ( isset($atts['text_size']) && $atts['text_size'] ) ||
				( isset($atts['text_color']) && $atts['text_color'] ) ||
				( isset($atts['text_weight']) && $atts['text_weight'] ) ||
				( isset($atts['margin']) && $atts['margin'] )) : ?>	
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> h1,
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> h2,
				#text-block-<?php echo esc_attr( $atts['id'] ); ?> h3{
					<?php if( $atts['text_color'] ) : ?>
						color: <?php echo esc_attr( $atts['text_color'] ); ?>;
					<?php endif;?>
					<?php if( $atts['text_size'] ) : ?>
						font-size: <?php echo esc_attr( $atts['text_size'] ); ?>;
					<?php endif;?>
					<?php if( $atts['text_weight'] ) : ?>
						font-weight: <?php echo esc_attr( $atts['text_weight'] ); ?>;
					<?php endif;?>
					<?php if( $atts['margin'] ) : ?>
						margin: <?php echo esc_attr( $atts['margin'] ); ?>;
					<?php endif; ?>
				}
			<?php endif;			
			$custom_css = ob_get_contents(); 
			ob_end_clean();
			wp_add_inline_style( 'hypermarket-child-style', zafirah_compress($custom_css));
		}

		
		public function zafirah_css_compression(){
			// specify your css-files and their order here
			$cssFiles = array(
			  
			);
			// the file to write the compressed css to
			$minFileName = 'https://zafirahonline.com/wp-content/themes/Zafirah-Child-1.0.6/assets//css/main.css';
			
			// thats all, just call this file in your browser and it will
			// build you a minimized css-file. then just link to this single
			// file and you're done.
			
			
			/**
			 * This function takes a css-string and compresses it, removing
			 * unneccessary whitespace, colons, removing unneccessary px/em
			 * declarations etc.
			 *
			 * @param string $css
			 * @return string compressed css content
			 * @author Steffen Becker
			 */
			function minifyCss($css) {
			  // some of the following functions to minimize the css-output are directly taken
			  // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
			  // all credits to Christian Schaefer: http://twitter.com/derSchepp
			
			  // remove comments
			  $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
			
			  // backup values within single or double quotes
			  preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
			  for ($i=0; $i < count($hit[1]); $i++) {
			    $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
			  }
			
			  // remove traling semicolon of selector's last property
			  $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
			  // remove any whitespace between semicolon and property-name
			  $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
			  // remove any whitespace surrounding property-colon
			  $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
			  // remove any whitespace surrounding selector-comma
			  $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
			  // remove any whitespace surrounding opening parenthesis
			  $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
			  // remove any whitespace between numbers and units
			  $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
			  // shorten zero-values
			  $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
			  // constrain multiple whitespaces
			  $css = preg_replace('/\p{Zs}+/ims',' ', $css);
			  // remove newlines
			  $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
			
			  // Restore backupped values within single or double quotes
			  for ($i=0; $i < count($hit[1]); $i++) {
			    $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
			  }
			
			  return $css;
			}
			
			// execute it
			$cssContents = '';
			foreach($cssFiles as $file) {
			  $cssContents .= file_get_contents($file);
			}
			file_put_contents($minFileName, minifyCss($cssContents));
			
			wp_add_inline_style( 'hypermarket-child-style', minifyCss($cssContents));

		}
		
		// Our hooked in function - $fields is passed via the filter!
		public function custom_override_checkout_fields( $fields ) {
		     unset($fields['billing']['billing_city']);
		
		     return $fields;
		}

		
		public function zafirah_widgets_init(){
			register_sidebar( array(
				'name'          => esc_html__( 'Product Search Sidebar', 'frontlash' ),
				'id'            => 'search-sidebar',
				'description'   => esc_html__( 'Add product search widgets here.', 'frontlash' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '',
				'after_title'   => '',
			) );
		}
	}
endif;
return new Hypermarket_Child();


/**
 * Override Footer credit.
 *
 * @since 1.0.0
 */

function hypermarket_credits(){
    echo '<p class="copyright space-top"><span>' . apply_filters('hypermarket_copyright_text', $content = '&copy; ' . get_bloginfo('name') . ' ' . date_i18n(__('Y','hypermarket'))) . '</span>';
    if( apply_filters( 'hypermarket_credit_link', true ) ):
        // You `HAVE` to keep this credit link. We really do appreciate it ;)
        printf(esc_attr__(' | All Rights Reserved.', 'hypermarket') , '<a href="' . esc_url(HYPERMARKET_THEME_URI ) . '" rel="author" target="_blank">' . esc_attr(HYPERMARKET_THEME_NAME) . '</a>');
    endif;
    echo '</p>';
}


function hypermarket_cart_link(){
	if (hypermarket_is_woocommerce_activated()):
	?>
		<a class="cart-items <?php echo (apply_filters('hypermarket_toolbar_toggle_cls', false)) ? 'toolbar-toggle' : ''; ?>" href="<?php echo esc_url(wc_get_cart_url()); ?>" target="_self">
            <i>
            	<span class="material-icons shopping_cart"></span>
        		<?php
					// Number of items present and the cart total
					$cart_items = wp_kses_data(WC()->cart->get_cart_contents_count());
					echo ($cart_items != 0) ? '<span class="count">' . intval($cart_items) . '</span>' : '';
				?>
            </i>
        </a><!-- .cart-items -->
	<?php
	endif;
}

/**
 * Shortcode Options
*/
function zafirah_shortcode_options($data,$shortcode){
    $atts = shortcode_parse_atts( $data['atts_string'] );
    if( is_array($atts) ) :
        $atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);
    endif;
    return $atts;
}
/**
 * Minify output
 */
function zafirah_compress($buf){
    return preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
   	 {
   		 $this->parseHTML($html);
   	 }
    }
    public function __toString()
    {
   	 return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
   	 $raw = strlen($raw);
   	 $compressed = strlen($compressed);
   	 
   	 $savings = ($raw-$compressed) / $raw * 100;
   	 
   	 $savings = round($savings, 2);
   	 
   	 return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
   	 $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
   	 preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
   	 $overriding = false;
   	 $raw_tag = false;
   	 // Variable reused for output
   	 $html = '';
   	 foreach ($matches as $token)
   	 {
   		 $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
   		 
   		 $content = $token[0];
   		 
   		 if (is_null($tag))
   		 {
   			 if ( !empty($token['script']) )
   			 {
   				 $strip = $this->compress_js;
   			 }
   			 else if ( !empty($token['style']) )
   			 {
   				 $strip = $this->compress_css;
   			 }
   			 else if ($content == '<!--wp-html-compression no compression-->')
   			 {
   				 $overriding = !$overriding;
   				 
   				 // Don't print the comment
   				 continue;
   			 }
   			 else if ($this->remove_comments)
   			 {
   				 if (!$overriding && $raw_tag != 'textarea')
   				 {
   					 // Remove any HTML comments, except MSIE conditional comments
   					 $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
   				 }
   			 }
   		 }
   		 else
   		 {
   			 if ($tag == 'pre' || $tag == 'textarea')
   			 {
   				 $raw_tag = $tag;
   			 }
   			 else if ($tag == '/pre' || $tag == '/textarea')
   			 {
   				 $raw_tag = false;
   			 }
   			 else
   			 {
   				 if ($raw_tag || $overriding)
   				 {
   					 $strip = false;
   				 }
   				 else
   				 {
   					 $strip = true;
   					 
   					 // Remove any empty attributes, except:
   					 // action, alt, content, src
   					 $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
   					 
   					 // Remove any space before the end of self-closing XHTML tags
   					 // JavaScript excluded
   					 $content = str_replace(' />', '/>', $content);
   				 }
   			 }
   		 }
   		 
   		 if ($strip)
   		 {
   			 $content = $this->removeWhiteSpace($content);
   		 }
   		 
   		 $html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
   	 $this->html = $this->minifyHTML($html);
   	 
   	 if ($this->info_comment)
   	 {
   		 $this->html .= "\n" . $this->bottomComment($html, $this->html);
   	 }
    }
    
    protected function removeWhiteSpace($str)
    {
   	 $str = str_replace("\t", ' ', $str);
   	 $str = str_replace("\n",  '', $str);
   	 $str = str_replace("\r",  '', $str);
   	 
   	 while (stristr($str, '  '))
   	 {
   		 $str = str_replace('  ', ' ', $str);
   	 }
   	 
   	 return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
