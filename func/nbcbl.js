jQuery.noConflict();
(function($) { 
	$(document).ready(function(){
		const attr = $('body').hasClass( 'logged-in' ); 
		if ( typeof attr == 'undefined' || attr == false )
		{
			$('.home-page-subtitle').append('<a id="home-page-subtitle-cta" class="kad-btn-primary kad-btn lg-kad-btn" href="/register/">Start Now!</a> ');
		}
		
	});
})(jQuery);

//logged-in