jQuery(document).ready(function () {
  'use strict';

  var $gif = $('#gif-popover');
  
  $('.js-gif-trigger').on('click', function() {
  	var gifsrc = $(this).attr('data-gif');
  	if ($gif.hasClass('gif-open')) {
  		//$gif.removeClass('gif-open');
  	}
  	$gif.css('background-image','url('+gifsrc+')').addClass('gif-open');
  });
  	
  $gif.on('click', function() {
		$gif.removeClass('gif-open');
  });

});
