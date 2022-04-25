//$(function(){

    //rinkerの画像にaltとクラス付与
    //$('#js-entryBody').find('.yyi-rinker-image').find('img').attr('alt', 'product image').addClass('lazyload');
    const rinkerImg = document.querySelectorAll('.yyi-rinker-image img');
    Array.prototype.forEach.call(rinkerImg, e => {
        //e.classList.add('lazyload');
        e.setAttribute('alt', 'product image');
    });

    
    //スムーズスクロール
    /*
    $('#js-entryBody').find('a[href^="#"]').on('click', function(){
        const speed = 300;
        const href= $(this).attr('href');
        const target = $(href == '#' || href == '' ? 'html' : href);
        let position = target.offset().top;
        $('html, body').animate({scrollTop:position}, speed, 'swing');
        return false;
    });
    */
    const easeInOut = function(t){
        if(t < 0.5){
            return 4*t*t*t;
        }else{
            return (t-1)*(2*t-2)*(2*t-2)+1;
        }
    };
    const entryBody = document.getElementById('js-entryBody'),
          anchor = entryBody.querySelectorAll('a[href^="#"]');
    Array.prototype.forEach.call(anchor, e1 => {
        e1.addEventListener('click', e2 => {
            const target = e2.target,
                  targetId = target.hash,
                  targetElement = document.querySelector(targetId),
                  rectTop = targetElement.getBoundingClientRect().top,
                  offsetTop = window.pageYOffset,
                  top = rectTop + offsetTop,
                  start = performance. now();
            
            e2.preventDefault();
            
            const step = function(nowTime){
                const time = nowTime - start,
                      normalizedTime = time / 500;
                if (normalizedTime < 1) {
                    window.scrollTo(0, offsetTop + ((top - offsetTop) * easeInOut(normalizedTime)));
                    requestAnimationFrame(step);
                } else {
                    window.scrollTo(0, targetPosition);
                }
            }
            requestAnimationFrame(step);
            /*
            window.scrollTo({
                top,
                behavior: 'smooth'
            });
            */
        });
    });

    
    //rinkerクリック計測
    /*
    $('#js-entryBody').on('click', '.yyi-rinker-tracking', function(event){
        try {
            var category = 'Rinker';
            var event_label = $(this).data('click-tracking');

            if (typeof gtag !== 'undefined' && $.isFunction(gtag)){
                gtag('event', 'click', {
                    'event_category': 'Rinker',
                    'event_label': event_label
                });
            } else if (typeof ga !== 'undefined'  && $.isFunction(ga)){
                ga( 'send', 'event', category, 'click', event_label );
            } else if (typeof _gaq !== 'undefined') {
                _gaq.push(['_trackEvent', category, 'click', event_label]);
            }
        } catch(e){
            console.log('tracking-error');
            console.log(e.message);
        }
    });
    */

