jQuery(document).ready(function($) {
    'use strict';
    
    //LOADER 
	if (document.documentElement.clientWidth <= 767) {
	    $(".loader").fadeOut(100);
	}
    
    $('.padding-top, .padding-top-2x').fadeIn(500);
    
    if (document.documentElement.clientWidth >= 767) {
		window.onscroll = function() {myFunction()};
		var navbar = document.getElementById("hypermarket-header");
		var sticky = navbar.offsetTop;
		
		function myFunction() {
		  if (window.pageYOffset >= sticky) {
		    navbar.classList.add("scroll-nav");
		  } else {
		    navbar.classList.remove("scroll-nav");
		  }
		}
	}

}); /*Document Ready End*/