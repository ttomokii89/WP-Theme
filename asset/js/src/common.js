$(function(){

	//メニュー
	$('#js-menu-btn').on('click', function(){
        $(this).toggleClass('is-open');
		$('#js-menu').toggleClass('is-open');
	});
	
	//pagetop
	var pagetop = $('#js-pagetop');
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			pagetop.addClass('is-appear');
		} else {
			pagetop.removeClass('is-appear');
		}
	});
	pagetop.on('click', function(){
		$('body, html').animate({ scrollTop: 0 }, 300);
		return false;
	});
    
    //スムーススクロール
    $('a[href^="#"]').click(function(){
        var speed = 300;
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });

});