jQuery(document).ready(function () {
  'use strict';

  // GIF POPOVER

  $('.js-gif-trigger').on('click', function() {
  	var gifsrc = $(this).attr('data-gif');
  	$('#gif-popover').css({
  		'background-image':'url('+gifsrc+')',
  		'transform':'scale(1)'
  	});
  });

  $('#gif-popover').on('click', function() {
		$(this).css('transform','scale(0)');
  });

  // MOBILE MENU

  $('#mobile-dock-toggle').on('click', function() {
		$('#mobile-dock').toggle();
  });

});
