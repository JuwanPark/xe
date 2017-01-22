jQuery(function($){
	function wresize() {
		var bodyheight = $(window).height() - ($('#siteheader').outerHeight() + $('#sitefooter').outerHeight());
		$('#sitebody').css('min-height', bodyheight + 'px');
		
		if ($(window).width() > 1000) {
			$('#toTop').css('right', (($(window).width() - 1000) / 2 + 10) + 'px');
		} else {
			$('#toTop').css('right', 10 + 'px');
		}
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
		
		$("#toTop").click(function () {
			$("body").animate({ scrollTop: 0 }, 200);
			return false;
		});
	});

	$(window).resize(function() {
		wresize();
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() != 0) {
			/* $('#toTop').fadeIn(); */
			$('#toTop').fadeIn(200);
		} else {
			/* $('#toTop').fadeOut(); */
			$('#toTop').fadeOut(200);
		}
	});	
});
