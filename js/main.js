jQuery(document).ready(function () {
  'use strict';
  
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

});
