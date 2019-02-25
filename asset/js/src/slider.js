$(function(){
    
    var target = $('#js-slider');
    var target_list = $('#js-slider_list');
    var target_item = target_list.children('li');
    var itemLength = target_item.length;
    var prev = $('#js-slider_prev');
    var next = $('#js-slider_next');
    var ctrl = $('#js-slider_ctrl');
    var width = target.width();
    var height = width * 0.5625;
    var currentPosition = 0;

    //初期設定
	target.css('height', height);
    target_item.css({'width': width, 'height': height});
    target_item.eq(0).addClass('current');
    
    //ページャーセット
    target_item.each(function(){
        ctrl.append('<li></li>');
    });
    ctrl.children('li:first-child').addClass('current');
    
    //ページャー処理
    ctrl.children('li').each(function(){
        $(this).on('click', function(){
            var clickNum = $(this).index();
            var current = $('.current');
            var currentNum = ctrl.children('li').index(current);
            var move = (currentNum - clickNum + 1) * width;
            $.when(
                target_list.animate({left: move}, 200)
            )
            .done(function(){
                var newCurrentPosition = target_list.css('left');
                var ncpInt = parseInt(newCurrentPosition);
                var wInt = parseInt(width);
                var newCurrentIndex = (ncpInt / wInt * -1);
                target_item.eq(newCurrentIndex).addClass('current');
            });
            ctrl.children('li.current').removeClass('current');
            target_list.children('li.current').removeClass('current');
            $(this).addClass('current');
        });
    });
    
    //左アロー
    prev.on('click', function() {
        var newCurrentPosition = currentPosition + width;
        if (currentPosition == 0) {
            //ループ処理
            var currentLast = -1 * (itemLength - 1) * width;
            var $clone = target_item.last().clone();
            target_item.removeClass('current');
            ctrl.children('li').removeClass('current');
            $.when(
                $clone.prependTo(target_list),
                target_list.css('left', -width)
            )
            .done(function(){
                target_list.animate({left: 0}, 200, function(){
                    target_list.css('left', currentLast);
                    $clone.remove();
                    currentPosition = currentLast;
                    target_list.children('li:last-child').addClass('current');
                    ctrl.children('li:last-child').addClass('current');
                });
            });
        } else {
            target_list.animate({left: newCurrentPosition}, 200);
            currentPosition = newCurrentPosition;
            target_list.children('li.current').removeClass('current').prev().addClass('current');
            ctrl.children('li.current').removeClass('current').prev().addClass('current');
        }
    });
    
    //右アロー
    next.on('click', function(){
        var newCurrentPosition = currentPosition - width;
        if (currentPosition == -1 * width * (itemLength - 1)) {
            //ループ処理
            var $clone = target_item.first().clone();
            target_item.removeClass('current');
            ctrl.children('li').removeClass('current');
            $clone.appendTo(target_list);
            target_list.animate({left: newCurrentPosition}, 200, function(){
                target_list.css('left', '0');
                $clone.remove();
                currentPosition = 0;
                target_item.eq(0).addClass('current');
                ctrl.children('li').eq(0).addClass('current');
            });
        } else {
            target_list.animate({left: newCurrentPosition}, 200);
            currentPosition = newCurrentPosition;
            target_list.children('li.current').removeClass('current').next().addClass('current');
            ctrl.children('li.current').removeClass('current').next().addClass('current');
        }
    });

});