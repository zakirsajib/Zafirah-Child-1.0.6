<?php
/**
 * Displaying header toolbar links.
 *
 * @package 	Hooked into "hypermarket_header_area"
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.4.1
 */
?>
<!-- Toolbar -->
<div class="toolbar">
    <div class="inner">
        <?php
        	// Append WooCommerce my-account page link
        	if (apply_filters('hypermarket_header_toolbar_myaccount', true) && hypermarket_is_woocommerce_activated() && get_option('users_can_register')):
        		echo '<a href="' . esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )) . '" target="_self"><i class="material-icons person"></i></a>';
        	endif;
            // Append WooCommerce Mini Cart
        	if (apply_filters('hypermarket_header_toolbar_mini_cart', true) && hypermarket_is_woocommerce_activated()):
            ?>
		        <div class="cart-btn">
	            	<?php do_action('hypermarket_items_present_in_cart'); ?>		
		            <!-- Cart Dropdown -->
		            <div class="cart-dropdown">
		            	<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</div>
		            <!-- .cart-dropdown -->
		        </div>
		        <!-- .cart-btn -->
    	<?php endif;
    	
    	echo '<a href="#" class="search-icon"><i class="material-icons search"></i>
        	<i class="material-icons close"></i></a>';
        	
        echo '<div id="zafirah-product-search" class="navbar-search-box">';
			if ( function_exists( 'aws_get_search_form' ) ) { aws_get_search_form();};
			echo '<div class="help-box">';
				echo '<i class="material-icons call"></i> <a href="tel:01794329050">017-9432-9050</a>';
			echo '</div>';
		echo '</div>';
		
		if(! hypermarket_is_woocommerce_activated()):
            echo '<a href="#" class="mobile-menu-toggle menu-text-right"><i class="material-icons sort"></i></a>';
        else:
            echo '<a href="#" class="mobile-menu-toggle"><i class="material-icons sort"></i></a>';
        endif;?>
    </div>
    <!-- .inner -->
</div>
<!-- .toolbar -->