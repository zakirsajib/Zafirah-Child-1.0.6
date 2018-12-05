/**
 * Hypermarket Child Theme
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket Child
 * @since       1.0.0
 */

jQuery(document).ready(function($) {
    'use strict';	
	
	$(".shop-thumbnail > img, .category-thumb > img, .swiper-slide > img").each(function() {
    	$(this).addClass('lazyload');
        $(this).attr("data-src",$(this).attr("src"));
        $(this).removeAttr("src");
    });
    
    // Hide loader icon after image loads
    $('.swiper-slide > img').load(function(){
	    $('.swiper-container').css('background','transparent');
    })
    
	
	
	/*----navbar-search----*/
    $('.search-icon').on('click', function (e) {
	    e.preventDefault();
        $('#zafirah-product-search').toggleClass("navbar-search-box-open");
        $(this).toggleClass("actives");

        if($(this).hasClass("actives")){
            $('.search-icon').toggleClass("material-icons close");
            $('.material-icons.search').css('display','none');
            $(this).css({"z-index": "100"});
        }else {
            $('.material-icons.search').css('display','inline-block');
            $('.search-icon').toggleClass("material-icons close");
        }
    });
}); /*Document Ready End*/