//元のやつ
javascript:(function(){(function(d,f,s){s=d.createElement("script");s.src="//j.mp/1bPoAXq";s.onload=function(){f(jQuery.noConflict(!0))};d.body.appendChild(s)})(document,function($){var obj = [];obj.title = $('title').text();obj.img = $('meta[property="og:image"]').attr('content');obj.desc = $('meta[name="description"]').attr('content');obj.url = document.URL;obj.domain = location.host;var cardTxt = '<div class="blogCardTxt"><p class="blogCardTitle"><a href="'+obj.url+'" target="_blank">'+obj.title+'</a></p><p>'+obj.desc+'</p></div>';var cardFooter = '<div class="blogCardFooter"><a href="'+obj.url+'"><img src="http://www.google.com/s2/favicons?domain='+obj.url+'" alt="">'+obj.domain+'</a></div>';if(obj.img == undefined){var card = '<div class="blogCard blogCard--noimg"><div class="blogCardCont">'+cardTxt+'</div>'+cardFooter+'</div>';}else{var cardImg = '<div class="blogCardImg"><div class="blogCardImg__wrap"><a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a></div></div>';var card = '<div class="blogCard"><div class="blogCardCont">'+cardTxt+cardImg+'</div>'+cardFooter+'</div>';}prompt('ブログカードのHTMLを生成しました。', card);})})();


//展開、整形
javascript : (function () {
    (function (d, f, s) {
        s = d.createElement("script");
        s.src = "//j.mp/1bPoAXq";
        s.onload = function () {
            f(jQuery.noConflict(!0))
        };
        d.body.appendChild(s)
    })(document, function ($) {
        var obj = [];
        obj.title = $('title').text();
        obj.img = $('meta[property="og:image"]').attr('content');
        obj.desc = $('meta[name="description"]').attr('content');
        obj.url = document.URL;
        obj.domain = location.host;
        var cardTxt = '<span class="card__title">' + obj.title + '</span><span class="card__excerpt">' + obj.desc + '</span><span class="card__url">' + obj.domain + '</span>';
        var cardImg;
        if(obj.img != undefined){
            cardImg = '<img class="lazyload" data-src="' + obj.img + '" alt="">';
        }else{
            cardImg = null;
        }
        var card = '<div class="card"><a class="card__wrap" href="' + obj.url + '" target="_blank" rel="noopenner"><span class="card__info">' + cardTxt + '</span><span class="card__thumb">' + cardImg + '</span></a></div>';
        prompt('ブログカードのHTMLを生成しました。', card);
    })
})();

//整形後minify
javascript:(function(){(function(d,f,s){s=d.createElement("script");s.src="//j.mp/1bPoAXq";s.onload=function(){f(jQuery.noConflict(!0))};d.body.appendChild(s)})(document,function($){var obj=[];obj.title=$('title').text();obj.img=$('meta[property="og:image"]').attr('content');obj.desc=$('meta[name="description"]').attr('content');obj.url=document.URL;obj.domain=location.host;var cardTxt='<span class="card__title">'+obj.title+'</span><span class="card__excerpt">'+obj.desc+'</span><span class="card__url">'+obj.domain+'</span>';var cardImg;if(obj.img!=undefined){cardImg='<img class="lazyload" data-src="'+obj.img+'" alt="">'}else{cardImg=null}var card='<div class="card"><a class="card__wrap" href="'+obj.url+'" target="_blank" rel="noopenner"><span class="card__info">'+cardTxt+'</span><span class="card__thumb">'+cardImg+'</span></a></div>';prompt('ブログカードのHTMLを生成しました。',card)})})();