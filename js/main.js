jQuery(document).ready(function () {
  'use strict';
  
  $('.js-gif-trigger').on('click', function() {
  	var gifsrc = $(this).attr('data-gif');
  	if ($('#gif-popover').length) {
  		$('#gif-popover').css('background-image','url('+gifsrc+')');
  	} else {
  		$('#main-container').append('<div id="gif-popover" style="background-image: url('+gifsrc+')"></div>');
  	}
  	$('#gif-popover').on('click', function() {
  		$(this).remove();
	  });
  });



});
