/* Login ajax */
function ajaxLogin(ajaxUrl, clear){
	if(clear == true){
		clearHolder();
		jQuery(".ajax-box-overlay").removeClass('loaded');
	}
	jQuery("#header").append("<div id='login-holder' />");
	if(!jQuery(".ajax-box-overlay").length){
		jQuery("#login-holder").after('<div class="ajax-box-overlay"><i class="load" /></div>');
		jQuery(".ajax-box-overlay").fadeIn('medium');
	}
	function overlayResizer(){
		jQuery(".ajax-box-overlay").css('height', jQuery(window).height());
	}
	overlayResizer();
	jQuery(window).resize(function(){overlayResizer()});
	
	jQuery.ajax({
		url: ajaxUrl,
		cache: false
	}).done(function(html){
		setTimeout(function(){
			jQuery("#login-holder").html(html).animate({
				opacity: 1,
				top: '100px'
			}, 500 );
			jQuery(".ajax-box-overlay").addClass('loaded');
			clearAll();
		}, 500);
	});
	
	var clearAll = function(){
		jQuery("#login-holder .close-button").on('click', function(){
			jQuery(".ajax-box-overlay").fadeOut('medium', function(){
				jQuery(this).remove();
			});
			clearHolder();
		});
	}
	function clearHolder(){
		jQuery("#login-holder").animate({
			opacity: 0,
			top: 0
		  }, 500, function() {
			jQuery(this).remove();
		});
	}
}

/* Top Cart */
function topCart(){
	jQuery('.top-cart .block-title a').on('click', function(){
		jQuery('.top-cart .block-title').parent().toggleClass('active');
		jQuery('#topCartContent').slideToggle(500).toggleClass('active')
		return false;
	});
}
/* Top Cart */

/* Wishlist Block Slider */
function wishlist_slider(){
  jQuery('#wishlist-slider .es-carousel').iosSlider({
	responsiveSlideWidth: true,
	snapToChildren: true,
	desktopClickDrag: true,
	infiniteSlider: false,
	navNextSelector: '#wishlist-slider .next',
	navPrevSelector: '#wishlist-slider .prev'
  });
}
 
function wishlist_set_height(){
	var wishlist_height = 0;
	jQuery('#wishlist-slider .es-carousel li').each(function(){
	 if(jQuery(this).height() > wishlist_height){
	  wishlist_height = jQuery(this).height();
	 }
	})
	jQuery('#wishlist-slider .es-carousel').css('min-height', wishlist_height+2);
}
if(jQuery('#wishlist-slider').length){
  whs_first_set = true;
  wishlist_slider();
}
/* Wishlist Block Slider */

jQuery(window).load(function() {

	/* Fix for IE */
    	if(navigator.userAgent.indexOf('IE')!=-1 && jQuery.support.noCloneEvent){
			jQuery.support.noCloneEvent = true;
		}
	/* End fix for IE */

	/* More Views Slider */
	if(jQuery('#more-views-slider').length){
	  jQuery('#more-views-slider').iosSlider({
		   responsiveSlideWidth: true,
		   snapToChildren: true,
		   desktopClickDrag: true,
		   infiniteSlider: false,
		   navSlideSelector: '.sliderNavi .naviItem',
		   navNextSelector: '.more-views .next',
		   navPrevSelector: '.more-views .prev'
		 });
		 
		
	 }
	 function more_view_set_height(){
		if(jQuery('#more-views-slider').length){
			var more_view_height = 0;
			jQuery('#more-views-slider li a').each(function(){
			 if(jQuery(this).height() > more_view_height){
			  more_view_height = jQuery(this).height();
			 }
			})
			jQuery('#more-views-slider').css('min-height', more_view_height+2);
		}
	 }
	 /* More Views Slider */

	 /* Related Block Slider */
	  if(jQuery('#block-related-slider').length) {
	  jQuery('#block-related-slider').iosSlider({
		   responsiveSlideWidth: true,
		   snapToChildren: true,
		   desktopClickDrag: true,
		   infiniteSlider: false,
		   navSlideSelector: '.sliderNavi .naviItem',
		   navNextSelector: '.block-related .next',
		   navPrevSelector: '.block-related .prev'
		 });
	 } 
	 
	 function related_set_height(){
		var related_height = 0;
		jQuery('#block-related-slider li.item').each(function(){
		 if(jQuery(this).height() > related_height){
		  related_height = jQuery(this).height();
		 }
		})
		jQuery('#block-related-slider').css('min-height', related_height+2);
	}
	 /* Related Block Slider */
	 
   /* Layered Navigation Accorion */
  if (jQuery('#layered_navigation_accordion').length) {
    jQuery('.filter-label').each(function(){
        jQuery(this).toggle(function(){
            jQuery(this).addClass('closed').next().slideToggle(200);
        },function(){
            jQuery(this).removeClass('closed').next().slideToggle(200);
        })
    });
  }
  /* Layered Navigation Accorion */


  /* Product Collateral Accordion */
  if (jQuery('#collateral-accordion').length) {
	  jQuery('#collateral-accordion > div.box-collateral').hide();  
	  jQuery('#collateral-accordion > h2').click(function() {
		jQuery(this).parent().find('h2').removeClass('active');
		jQuery(this).addClass('active');
		
	    var nextDiv = jQuery(this).next();
	    var visibleSiblings = nextDiv.siblings('div:visible');
	 
	    if (visibleSiblings.length ) {
	      visibleSiblings.slideUp(300, function() {
	        nextDiv.slideToggle(500);
	      });
	    } else {
	       nextDiv.slideToggle(300);
	    }
	  });
  }
  /* Product Collateral Accordion */

  /* My Cart Accordion */
  if (jQuery('#cart-accordion').length) {
	  jQuery('#cart-accordion > div.accordion-content').hide();	  
	  
	  jQuery('#cart-accordion > h3.accordion-title').wrapInner('<span/>').click(function(){
	  
		var accordion_title_check_flag = false;
		if(jQuery(this).hasClass('active')){accordion_title_check_flag = true;}
		jQuery('#cart-accordion > h3.accordion-title').removeClass('active');
		if(accordion_title_check_flag == false){
			jQuery(this).toggleClass('active');
	    }
		
		var nextDiv = jQuery(this).next();
	    var visibleSiblings = nextDiv.siblings('div:visible');
	 
	    if (visibleSiblings.length ) {
	      visibleSiblings.slideUp(300, function() {
	        nextDiv.slideToggle(500);
	      });
	    } else {
	       nextDiv.slideToggle(300);
	    }
		
	  });
	  
	  
  }
  /* My Cart Accordion */
  
  /* Shop By Block */
  jQuery('.block-layered-nav dl dt').wrapInner('<span />');
  
  /* Coin Slider */

	/* Fancybox */
	if (jQuery.fn.fancybox) {
		jQuery('.fancybox').fancybox();
	}
	/* Fancybox */

	/* Zoom */
	if (jQuery('#zoom').length) {
		jQuery('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
  	}
	/* Zoom */
		
	/* Responsive */
	var responsiveflag = false;
	var topSelectFlag = false;
	var menu_type = jQuery('#nav').attr('class');
	
	function mobile_menu(mode){
		switch(mode)
		 {
		 case 'animate':
		   if(!jQuery('.nav-container').hasClass('mobile')){
				jQuery(".nav-container").addClass('mobile');
				jQuery('.nav-container > ul').slideUp('fast');
				jQuery('.menu-button').removeClass('active');
				jQuery('.menu-button').on('click', function(){
					jQuery(this).toggleClass('active');
					jQuery('.nav-container > ul').slideToggle('medium');
				});
			   jQuery('.nav-container > ul a').each(function(){
					if(jQuery(this).next('ul').length || jQuery(this).next('div.menu-wrapper').length){
						jQuery(this).before('<span class="menu-item-button"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>')
						jQuery(this).next('ul, div.menu-wrapper').slideUp('fast');//
						jQuery(this).prev('.menu-item-button').on('click', function(){
							jQuery(this).toggleClass('active');
							jQuery(this).nextAll('ul, div.menu-wrapper').slideToggle('medium');
						});
					}
			   });
		   }
		   break;
		 default:
				jQuery(".nav-container").removeClass('mobile');
				jQuery('.menu-button').off();
				jQuery('.nav-container > ul').slideDown('fast');
				jQuery('.nav-container .menu-item-button').each(function(){
					jQuery(this).nextAll('ul').slideDown('fast');
					jQuery(this).remove();
				});
				jQuery('.nav-container .menu-wrapper').slideUp('fast');
		 }
	}
	
	function toplinks() {
		if (jQuery('.content-wrapper > .container_12').width() < 980) {
			jQuery('.header-right-box .links-button span').off();
			jQuery('.header-right-box .links').hide();
			jQuery('.header-right-box .links-button span').click(function() {
				jQuery('.header-right-box .links').slideToggle('fast').toggleClass('active');
			});
			/* jQuery('.company-links a').after('<i class="fa fa-plus"></i><i class="fa fa-minus"></i>');
			jQuery('.company-links a i').click(function() {
				jQuery('.company-links dd').slideToggle('fast');
			}); */
		}else{
			jQuery('.header-right-box .links').show();
			jQuery('.header-right-box .links-button span').off();
		}
	}
	toplinks();
	function accordion (status){
		if(status == 'enable'){
			jQuery('.footer-columns-block header, aside.sidebar .block:not(.opc-block-progress) .block-title').on('click', function(){
				jQuery(this).toggleClass("active").parent().find(".custom-footer-content, .block-content").slideToggle('medium');
				wishlist_slider();
			})
			jQuery('.footer-columns-block, aside.sidebar').addClass('accordion').find(".custom-footer-content, .block:not(.opc-block-progress) .block-content").slideUp('fast')
			jQuery('aside.sidebar .block:not(.opc-block-progress) .block-title strong span').before('<i class="fa fa-plus-square"></i><i class="fa fa-minus-square"></i></i>');
		}else{
			jQuery('.footer-columns-block header, aside.sidebar .block-title').removeClass("active").off().parent().find(".custom-footer-content, .block-content").slideDown('fast');
			jQuery('.footer-columns-block, aside.sidebar').removeClass('accordion');
			jQuery('aside.sidebar .block:not(.opc-block-progress) .block-title i').remove();
		}
	}
	
	 /* page title */
	function titleDivider(){
		setTimeout(function(){
			jQuery('.page-title, .footer-links-container header, .block .block-title, .box-reviews header, .cart-collaterals header').not('.title-buttons').each(function(){
				title_container_width = jQuery(this).width();
				title_width = jQuery(this).find('h1, h2, h3, span').innerWidth();
				if(jQuery(this).find('.fa').length) {
					icon_width = jQuery(this).find('.fa').innerWidth() + 10;
				} else {
					icon_width = 0;
				}
				divider_width = (title_container_width - (title_width + icon_width)-2);
				if(!jQuery(this).find('.right-divider').length) {
					jQuery(this).prepend('<div class="right-divider" />');
				}
				jQuery(this).find('.right-divider').css('width', divider_width);
			});
		}, 200);
	}
	
	function toDo(){
		if (jQuery(document.body).width() < 767 && responsiveflag == false){
		    accordion('enable');
			
			/* Top Menu Select */
			if(topSelectFlag == false){
				jQuery('.nav-container .sbSelector').wrapInner('<span />').prepend('<span />');
				topSelectFlag = true;
			}
			jQuery('.nav-container .sbOptions li a').on('click', function(){
				if(!jQuery('.nav-container .sbSelector span').length){
					jQuery('.nav-container .sbSelector').wrapInner('<span />').prepend('<span />');
				}
			});
			/* //Top Menu Select */
			responsiveflag = true;
		}
		else if (jQuery(document.body).width() > 767){
			accordion('disable');
			responsiveflag = false;
		}
	}
	function replacingClass () {
		if (jQuery('.content-wrapper > .container_12').width() < 978) { //Mobile + Tablet
			mobile_menu('animate');
		}
		if (jQuery('content-wrapper > .container_12').width() > 977){ //Desktop + Extra Large
			mobile_menu('reset');
		}
	}
	replacingClass();
	toDo();
	titleDivider();
	more_view_set_height();
	wishlist_set_height();
	related_set_height();
	//menuHeight2();
	jQuery(window).resize(function(){toDo(); replacingClass(); more_view_set_height(); wishlist_set_height(); related_set_height(); toplinks(); titleDivider();});
	/* Responsive */
	
	/* Top Menu */
	function menuHeight2 () {
		var menu_min_height = 0;
		jQuery('#nav li.tech').css('height', 'auto');
		jQuery('#nav li.tech').each(function(){
			if(jQuery(this).height() > menu_min_height){
				menu_min_height = jQuery(this).height();
			}
		});		
		jQuery('#nav li.tech').each(function(){
			jQuery(this).css('height', menu_min_height + 'px');
		});
	}
	
	/* Top Selects */
	function option_class_add(items, is_selector){
		jQuery(items).each(function(){
			if(is_selector){
				jQuery(this).removeAttr('class'); 
				jQuery(this).addClass('sbSelector');
			}			
			stripped_string = jQuery(this).html().replace(/(<([^>]+)>)/ig,"");
			RegEx=/\s/g;
			stripped_string=stripped_string.replace(RegEx,"");
			jQuery(this).addClass(stripped_string.toLowerCase());
			if(is_selector){
				tags_add();
			}
		});
	}
	option_class_add('.form-language .sbOptions li a, .form-language .sbSelector, .form-currency .sbOptions li a, .form-currency .sbSelector, .toolbar .sbOptions li a, .toolbar .sbSelector, .shipping .sbOptions li a, .shipping .sbSelector', false);
	jQuery('.form-language .sbOptions li a, .form-currency .sbOptions li a, .toolbar .sbOptions li a, .shipping .sbOptions li a').on('click', function(){
		option_class_add('.form-language .sbSelector, .form-currency .sbSelector, .toolbar .sbSelector, .shipping .sbSelector', true);
	});	
	function tags_add(){
		jQuery('.form-language .sbSelector, .form-currency .sbSelector, .toolbar .sbSelector, .shipping .sbSelector').each(function(){
			if(!jQuery(this).find('span.text').length){
				jQuery(this).wrapInner('<span class="text" />').append('<span />').find('span:last').wrapInner('<span />');
			}
		});
	}
	tags_add();
	/* //Top Selects */
	
	
	if (jQuery('body').hasClass('retina-ready')) {
		/* Mobile Devices */
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i))){
			
			/* Mobile Devices Class */
			jQuery('body').addClass('mobile-device');
			
			/* Menu */
			jQuery(".nav-container:not('.mobile') #nav li").on({
	            click: function (){
	                if ( !jQuery(this).hasClass('touched') && jQuery(this).children('ul').length ){
						jQuery(this).addClass('touched');
						clearTouch(jQuery(this));
						return false;
	                }
	            }
	        });
			
			/* Clear Touch Function */
			function clearTouch(handlerObject){
				jQuery('body').on('click', function(){
					handlerObject.removeClass('touched closed');
					if(handlerObject.parent().attr('id') == 'categories-accordion'){
						handlerObject.children('ul').slideToggle(200);
					}
					jQuery('body').off();
				});
				handlerObject.click(function(event){
					event.stopPropagation();
				});
				handlerObject.parent().click(function(){
					handlerObject.removeClass('touched');
				});
				handlerObject.siblings().click(function(){
					handlerObject.removeClass('touched');
				});
			}
			
			var mobileDevice = true;
		}else{
			var mobileDevice = false;
		}

		//images with custom attributes
		
		if (pixelRatio > 1) {
			function logoResize(){
				jQuery('header#header h1.logo, header#header h1.small-logo').each(function(){
					jQuery(this).attr('style', '');
					jQuery(this).find('a.logo img').attr('style', '');
					jQuery(this).find('a.logo img').css('width', (jQuery(this).find('a.logo').width()/2));
					if(!jQuery(this).hasClass('small-logo')){
						jQuery(this).css({
							'position': 'static',
							'opacity': '1'
						});
					}
				});
			}
			logoResize();
			jQuery(window).resize(function(){
				logoResize();
			});
		}
    }
	
	
	/* Categories Accorion */
	if (jQuery('#categories-accordion').length){
		jQuery('#categories-accordion li.parent ul').before('<div class="btn-cat"><i class="fa fa-minus-square"></i><i class="fa fa-plus-square"></i></div>');
		jQuery('#categories-accordion li:not(.parent) a').before('<i class="fa fa-dot-circle-o"></i>');
		if(mobileDevice == true){
			jQuery('#categories-accordion li.parent').each(function(){
				jQuery(this).on({
					click: function (){
						if(!jQuery(this).hasClass('touched')){
							jQuery(this).addClass('touched closed').children('ul').slideToggle(200);
							clearTouch(jQuery(this));
							return false;
						}
					}
				});
			});
		}else{
			jQuery('#categories-accordion li.parent .btn-cat').each(function(){
				jQuery(this).toggle(function(){
					jQuery(this).addClass('closed').next().slideToggle(200);
					jQuery(this).prev().addClass('closed');
				},function(){
					jQuery(this).removeClass('closed').next().slideToggle(200);
					jQuery(this).prev().removeClass('closed');
				})
			});
		}
	}
	/* Categories Accorion */
	
});
var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
jQuery(document).ready(function(){

	if (jQuery('body').hasClass('retina-ready')) {
		if (pixelRatio > 1) {
			jQuery('img[data-srcX2]').each(function(){
				jQuery(this).attr('src',jQuery(this).attr('data-srcX2'));
			});
			jQuery('.content-bottom[data-srcX2]').each(function(){
				jQuery(this).attr('style',jQuery(this).attr('data-srcX2'));
			});
		}
	}

	/* Header Selects */
	if(!jQuery(".form-language .sbHolder").length || !jQuery(".form-currency .sbHolder").length || !jQuery(".toolbar .sbHolder").length){
		jQuery(".form-language select, .form-currency select, .toolbar select").selectbox();
	}
	
	/* Top links  */
	jQuery('.links-container .links > li > a').wrapInner('<span />');
	
	 
	/* Messages button */
	if(jQuery('ul.messages').length){
		jQuery('ul.messages > li').each(function(){
			switch (jQuery(this).attr('class')){
			   case 'success-msg':
					messageIcon = '<i class="fa fa-check" />';
			   break;
			   case 'error-msg':
					messageIcon = '<i class="fa fa-times" />';
			   break;
			   case 'note-msg':
					messageIcon = '<i class="fa fa-exclamation" />';
			   break;
			   case 'notice-msg':
					messageIcon = '<i class="fa fa-exclamation" />';
			   break;
			}
			jQuery(this).prepend('<div class="messages-close-btn"><i class="fa fa-times" /></div>', messageIcon);
			jQuery('ul.messages .messages-close-btn').on('click', function(){
				jQuery('ul.messages').remove();
			});
		});
	}
	jQuery ("#nav > .parent > a > span, #nav-wide > .parent > a > span").after("<i class='fa fa-chevron-circle-down'></i>");
	
	if (jQuery('.block-account').length){
		jQuery('.block-account ul li').append('<i class="fa fa-minus"></i>');
	}
	function focus() {
		jQuery('header#header .form-search .indent input').focusin(function() {
			jQuery('header#header .form-search').addClass('focus');
		});
		jQuery('header#header .form-search .indent input').focusout(function() {
			jQuery('header#header .form-search').removeClass('focus');
		});
		jQuery('footer#footer #newsletter-validate-detail input').focusin(function() {
			jQuery('footer#footer #newsletter-validate-detail').addClass('focus');
		});
		jQuery('footer#footer #newsletter-validate-detail input').focusout(function() {
			jQuery('footer#footer #newsletter-validate-detail').removeClass('focus');
		});
	}
	focus();
	/* Company Link */
	var companyLinks = jQuery('header#header dl.company-links');
	jQuery('header#header .links').each(function(){
		if(!jQuery(this).parent().parent().hasClass('company-links')){
			jQuery(this).find('li:last').prev().after('<li class="company"><dl class="company-links">' + companyLinks.html() + '</dl></li>');
		}
	});
	companyLinks.remove();
	jQuery('header#header dl.company-links').on('mouseenter mouseleave', function(){
		jQuery(this).find('dt a').toggleClass('active').parent().next('dd').stop().slideToggle('fast');
	});
	
	if(jQuery('#nav-wide').length){
		jQuery('#nav-wide li.level-top').on('mouseenter mouseleave', function(){
			jQuery(this).toggleClass('over');
		});
		jQuery('.nav-wide#nav-wide .menu-wrapper > div.alpha.omega:first').addClass('first');
	}

	/* floating header */
	if(jQuery('body').hasClass('floating-header')){
		jQuery(window).scroll(function(){
			if(jQuery(this).scrollTop() >= 185 ){
				if(!jQuery('#header').hasClass('floating')){
					jQuery('body').css('padding-top', jQuery('#header').height());
					jQuery('#header').addClass('floating');
					jQuery('#header').slideDown('fast');
				}
			}
			if(jQuery(this).scrollTop() < 185 ){
				if(jQuery('#header').hasClass('floating')){
					jQuery('body').attr('style', '');
					jQuery('#header').removeClass('floating');
					jQuery('#header').attr('style', '');
				}
			}
		});
	}
	
	/* color block  */
	if(jQuery('.color-block').length){
		function colorBlock(){
			jQuery('.color-block').each(function(){
				blockHeight = jQuery(this).height() + parseFloat(jQuery(this).css('padding-top'));
				blockWidth = jQuery(this).width()+30;
				siteWidth = jQuery(window).width();
				bg = jQuery(this).find('.color-box-bg');
				bg.attr('style', '');
				bgIndent = bg.offset().left;
				if(jQuery('body').hasClass('boxed-layout')){
					bg.css({
						'width': blockWidth,
						'left': '-15px'
					});
				}else{
					bg.css({
						'left': '-'+bgIndent+'px',
						'width': siteWidth+'px',
						'height': blockHeight
					});
				}
			});
		}
		colorBlock();
		jQuery(window).resize(function(){colorBlock()});
	}
	
	
});