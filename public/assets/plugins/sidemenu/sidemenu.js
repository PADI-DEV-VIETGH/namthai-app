$(function() {
	$('.main-sidebar .with-sub').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$(document).on('click touchstart', function(e) {
		e.stopPropagation();
		// closing of sidebar menu when clicking outside of it
		if (!$(e.target).closest('.main-header-menu-icon').length) {
			var sidebarTarg = $(e.target).closest('.main-sidebar').length;
			if (!sidebarTarg) {
				$('body').removeClass('main-sidebar-show');
			}
		}
	});

	$(document).on('click', '#mainSidebarToggle' ,function(event) {
		event.preventDefault();
		if (window.matchMedia('(min-width: 992px)').matches) {
			$('body').toggleClass('main-sidebar-hide');
		} else {
			$('body').toggleClass('main-sidebar-show');
		}
	});
	$(".side-menu").hover(function() {
		if ($('body').hasClass('main-sidebar-hide')) {
			$('body').addClass('main-sidebar-open');
		}
	}, function() {
		if ($('body').hasClass('main-sidebar-hide')) {
			$('body').removeClass('main-sidebar-open');
		}
	});


	// ______________main-sidebar Active Class
	function addActiveClass(element) {
		if (current === "") {
		  if (element.attr('href').indexOf("#") !== -1) {
			element.parents('.main-sidebar .nav-item').last().removeClass('active');
			if (element.parents('.main-sidebar .nav-sub').length) {
			  element.closest('.main-sidebar .nav-item.active').removeClass('show');
			  element.parents('.main-sidebar .nav-sub-item').last().removeClass('active');
			}
		  }
		} else {
			if (element.attr('href').indexOf(current) !== -1) {
				element.parents('.main-sidebar .nav-item').last().addClass('active');
				if (element.parents('.main-sidebar .nav-sub').length) {
				  element.closest('.main-sidebar .nav-item.active').addClass('show');
				   element.parents('.main-sidebar .nav-sub-item').last().addClass('active');
				}
			}
		}
	}

	const current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    const currentLocation = window.location.origin + window.location.pathname
    let matchLocation = null;
	$('.main-sidebar .nav li a').each(function() {
		if (currentLocation === $(this).attr('href')) {
            matchLocation = $(this);
        }
    });
	if (matchLocation) {
	    addActiveClass(matchLocation);
    } else  {
	    const pathEx = location.pathname.split('/');
	    const parentLocation = window.location.origin + '/' + pathEx[1];
        $('.main-sidebar .nav li a').each(function() {
            if (parentLocation === $(this).attr('href')) {
                $(this).parents('.main-sidebar .nav-item').last().addClass('active').addClass('show');
                $(this).parents('.main-sidebar .nav-sub-item').last().addClass('active').addClass('show');
                $(this).addClass('active')
            }
        });
    }


	$('.main-sidebar-custom .nav li a').each(function() {
        if (window.location.href.trim() === $(this).attr('href').trim()) {
            $(this).parents('.main-sidebar .nav-item').last().addClass('active').addClass('show');
            $(this).parents('.main-sidebar .nav-sub-item').last().addClass('active').addClass('show');
            $(this).addClass('active')
        }
	});


	/*---Scroling ---*/
	//P-scroll
	new PerfectScrollbar('.side-menu', {
		suppressScrollX: true
	});

});