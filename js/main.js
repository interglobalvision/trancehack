var gifPopover = $('#gif-popover');

jQuery(document).ready(function () {
  'use strict';

  // GIF POPOVER

  $('.js-gif-trigger').on('click', function() {
  	var gifsrc = $(this).attr('data-gif');
    if ($('#mobile-dock').hasClass('active')) {
      $('#mobile-dock').removeClass('active');
    }
  	if (gifPopover.hasClass('open')) {
      if (gifPopover.css('background-image') == 'url('+gifsrc+')') {
    		gifPopover
        .transition({scale: 0, duration: 300}).removeClass('open');
      } else {
        gifPopover
        .transition({scale: 0, duration: 300}, function() {
          gifPopover
          .css({'background-image':'url('+gifsrc+')'})
          .transition({scale: 1, duration: 300});
        });
      }
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
    if (gifPopover.hasClass('open')) {
      gifPopover.transition({scale: 0, duration: 300}).removeClass('open');
    }
  });

  // INFINITE SCROLL

  $('#posts').infinitescroll({
    navSelector  : "#pagination",            
    nextSelector : "#pagination a:first",    
    itemSelector : "#posts article.post",
    loading: {
      finished: null,
      finishedMsg: null,
      img: null,
      msg: null,
      msgText: null,
      selector: null,
      speed: 'fast',
      start: undefined
    }
  });

});
