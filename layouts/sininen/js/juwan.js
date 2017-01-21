jQuery(function($){
	function wresize() {
		var bodyheight = $(window).height() - ($('#siteheader').outerHeight() + $('#sitefooter').outerHeight());
		$('#sitebody').css('min-height', bodyheight + 'px');
	}

	$(document).ready(function() {
		wresize();

		$('#login_btn').click(function() {
			$('#login_bg').fadeIn(250);
			return false;
		});

		$('#login_close').click(function() {
			$('#login_bg').fadeOut(250);
			return false;
		});
	});

	$(window).resize(function() {
		wresize();
	});
});
