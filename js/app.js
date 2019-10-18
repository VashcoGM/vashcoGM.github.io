   /*----------------------------
    START - Preloader
  ------------------------------ */
	jQuery(window).on('load', function () {
		jQuery("#preloader").fadeOut(1000);
	});


	/*----------------------------
    START - CLIENT SLIDER
    ------------------------------ */
	$('.partner-slide').owlCarousel({
        dots:false,
        nav:false,
        loop:true,
        autoplay:true,
        responsive:{
            0:{
                items:1,
				margin: 0
            },
            360:{
                items:2,
				margin: 30
            },
            600:{
                items:3,
				margin: 30
            },
            1200:{
                items:4,
				margin: 30
            }
        }
    });


    /*----------------------------
    START - Scroll to Top
    ------------------------------ */
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > 600) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	$('.scrollToTop').on('click', function () {
		$('html, body').animate({scrollTop : 0},2000);
		return false;
	});



    /*----------------------------
    FORM SUBMISSION HANDLER
    ------------------------------ */

	const form = document.getElementById('myForm');

    myForm.addEventListener('submit', (e)=> {
        // e.preventDefault();
    });

