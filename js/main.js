var gifPopover = $('#gif-popover');

jQuery(document).ready(function () {
  'use strict';

  // GIF POPOVER

  $('.js-gif-trigger').on('click', function() {
  	var gifsrc = $(this).attr('data-gif');
  	gifPopover.css({
  		'background-image':'url('+gifsrc+')',
  		'transform':'scale(1)'
  	});
  });

  gifPopover.on('click', function() {
		$(this).css('transform','scale(0)');
  });

  // MOBILE MENU

  $('#mobile-dock-toggle').on('click', function() {
		$('#mobile-dock').toggleClass('active');
  });

});
