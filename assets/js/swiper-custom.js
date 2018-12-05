jQuery(document).ready(function($) {
    'use strict';
    
    var mySwiper = new Swiper ('.swiper-container', {
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
  		},
  		pagination: {
  			el: '.swiper-pagination',
  			dynamicBullets: true,
  		},
  		autoplay: {
  			delay: 4800,
  			disableOnInteraction: true,
  		},
  		keyboard: {
	    	enabled: true,
			onlyInViewport: false,
	  	},
	  	effect: 'fade',
  		autoHeight: true,
		loop: true
	});
}); /*Document Ready End*/