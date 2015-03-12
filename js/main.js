var gifPopover = $('#gif-popover');

jQuery(document).ready(function () {
  'use strict';

  // GIF POPOVER

  $('.js-gif-trigger').on('click', function() {
  	var gifsrc = $(this).attr('data-gif');
  	if (gifPopover.hasClass('open')) {
  		gifPopover
  		.transition({scale: 0, duration: 300}, function() {
  			gifPopover
  			.css({'background-image':'url('+gifsrc+')'})
  			.transition({scale: 1, duration: 300});
  		});
  	} else {
	  	gifPopover
	  	.css({'background-image':'url('+gifsrc+')'})
	  	.transition({scale: 1, duration: 300})
	  	.addClass('open');
	  }
  });

  gifPopover.on('click', function() {
		$(this).transition({scale: 0, duration: 300}).removeClass('open');
  });

  // MOBILE MENU

  $('#mobile-dock-toggle').on('click', function() {
		$('#mobile-dock').toggleClass('active');
  });

  // INFINITE SCROLL

  $('#posts').infinitescroll({
    navSelector  : "#pagination",            
    nextSelector : "#pagination a:first",    
    itemSelector : "#posts article.post"          
  });

});
