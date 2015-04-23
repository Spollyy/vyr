$(document).ready(function () {
	/* Search */
	$(".search img").click(function(){
		$('.search-wrap').animate({
			"opacity" : "toggle"}, "fast"
		);
	});	
	
	$(".search i").click(function(){
		$('.search-wrap').animate({
			"opacity" : "toggle"}, "fast"
		);
	});	
	
	/* hover block users */
	$('.js-complain').hover(function(e){
		$(this).closest('.js-complain').find('.complain').toggleClass('visible');		
	}).on('click', '.js-open-desc', function(e) {	
		e.stopPropagation();
	});
	$('.js-open-desc').click(function(e){
		$(this).closest('.b-problem').find('.desc').toggleClass('slideInDown').animate({
			"opacity" : "toggle"}, "fast"			
		);	
		$(this).find('i').animate({
			"opacity" : "toggle"}, "fast"			
		)	
	});	
	$('.b-problem .desc b').click(function(){
		$(this).closest('.b-problem').find('.desc').toggleClass('slideInDown').animate({
			"opacity" : "toggle"}, "fast"			
		);	
		$('.b-problem i').show();
	});
	
	/* popup share */
	$('.js-open-share-popup').click(function(){			
		$(this).closest('.share').find('.share_icons').animate({
			"opacity": "toggle"
			}, "fast");
        $(".share button").toggleClass('active');
	});

    $(".share button").click(function(){
        $('.share-wrap').animate({
            "opacity": "toggle"
        }, "fast");
    });

    $(".share-wrap").click(function(){
        $(".share_icons").css('display', 'none');
        $(this).css('display', 'none');
        $(".share button").toggleClass('active');
    });
	
	/* hover on metka */
	$('a.metka').hover(function() {
		$(this).closest('.js-complain').find('.show-to-map').toggleClass('visible');		
	});

	$('.save').hover(function() {
		$('.show-to-map.v3').toggleClass('visible');		
	});
	
	$('.cancel').hover(function() {
		$('.show-to-map.v4').toggleClass('visible');		
	});
		
	/* Tabs comments */
	$(function() {
	// Добавим сразу же видимость первым элементам табов
	$('ul.i-tab3 li:first').addClass ('active');
	$('ul.tab-content3 li:first').css ('display', 'block');
	// Добавим «кликнотому» элементу класс .active
	$('ul.i-tab3').delegate('li:not(.active)', 'click', function() {
		// И удалим у предыдущего
		$(this).addClass('active').siblings().removeClass('active')
			.parents('.tabs3').find('ul.tab-content3 li').hide()
			// Посчитаем по какому по счету табу мы кликнули 
			// и откроем соотвествующий элемент
			.eq($(this).index()).fadeIn('slow');
		})
	});
	
	/* Быбор цели для формы */
	$(".mark span").click(function(){
		var $container = $(this).closest('.mark');
		$container.find('ul').animate({
			"opacity": "toggle"
		}, "fast");
		$container.find('.mark b').css('display', 'block');
		$(this).toggleClass('active');
	});
	
	$(".mark i").click(function(){		
		$('.mark b').css('display', 'block');
		var $container = $(this).closest('.mark');
		$container.find('ul').animate({
			"opacity": "toggle"
		}, "fast");		
		$container.find('span').toggleClass('active');
	});
	
	$(".mark b").click(function(){
        $("form ul").css('display', 'none');
        $(this).css('display', 'none');
        $("span").toggleClass('active');
    });
		
	$('.js_mark_form li').click(function() {
		var $container = $(this).closest('.mark');
		$container.find('i.js-chose-mark').html($(this).html());
		$container.find(".mark span").removeClass('active');
		$container.find('ul').hide();
		$('.mark b').css('display', 'none');
		 $container.find("span").toggleClass('active');
	});
	
	 	
		
});















