/* 
	Develope by : So-creative
	 
*/

$(document).ready(function(){
	$('.dropdown_menu').on('mouseenter', function() 
	{
		$(this).addClass("highlight");
	});
	$('.dropdown_menu').on('mouseleave', function() 
	{
		$(this).removeClass("highlight");
	});
	$(document).on('click','.search-btn',function(){
		if($('.search-popup').hasClass('d-none'))
		{
			$('.search-popup').removeClass('d-none')
		}
		else
		{
			$('.search-popup').addClass('d-none')
		}
	})
	if($('.unique_sliders').length)
	{
		$('.unique_sliders').slick({
		    //infinite: true,
		  	slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			draggable: true,
			loop: true,
			arrows: true,
		 	autoplaySpeed: 3000,
		 	responsive: [
			{
			  breakpoint: 1000,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 770,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		  ]
		});
	}
	if($('.about_sliders').length)
	{
		$('.about_sliders').slick({
			//infinite: true,
				slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			draggable: true,
			loop: true,
			arrows: true,
				autoplaySpeed: 3000,
				responsive: [
			{
				breakpoint: 1000,
				settings: {
				slidesToShow: 3,
				slidesToScroll: 1
				}
			},
			{
				breakpoint: 770,
				settings: {
				slidesToShow: 2,
				slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			}
			]
		});
	}
	if($('.mobile-image-slides').length)
	{
		$('.mobile-image-slides').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			draggable: true,
			loop: true,
			dots:true,
			arrows: false,
				autoplaySpeed: 3000,
				responsive: [
			{
				breakpoint: 1000,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			},
			{
				breakpoint: 770,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			}
			]
		});
	}
	if($('.boat_type_slider').length)
		{
			$('.boat_type_slider').slick({
				//infinite: true,
				  slidesToShow: 2,
				slidesToScroll: 1,
				autoplay: false,
				draggable: true,
				loop: true,
				arrow: true,
				 autoplaySpeed: 3000,
				 responsive: [
				{
				  breakpoint: 1000,
				  settings: {
					slidesToShow: 2,
					autoplay: true,
					arrow: false,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 770,
				  settings: {
					slidesToShow: 1,
					autoplay: true,
					arrow: false,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					slidesToShow: 1,
					autoplay: true,
					arrow: false,
					slidesToScroll: 1
				  }
				}
			  ]
			});
		}
		if($('.featured_boat_slider').length)
			{
				$('.featured_boat_slider').slick({
					//infinite: true,
					  slidesToShow: 3,
					slidesToScroll: 1,
					autoplay: true,
					draggable: true,
					loop: true,
					arrow: true,
					 autoplaySpeed: 3000,
					 responsive: [
					{
					  breakpoint: 1000,
					  settings: {
						slidesToShow: 2,
						arrows: false,
						slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 770,
					  settings: {
						slidesToShow: 1,
						arrows: false,
						slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						slidesToShow: 1,
						arrows: false,
						slidesToScroll: 1
					  }
					}
				  ]
				});
			}
			$(document).ready(function () {
				const isHomePage = window.location.pathname === "/" || window.location.pathname === "/index.html";
				const isMobile = window.innerWidth <= 770;
			  
				if (isHomePage && isMobile && $('.home_review_slider').length) {
				  $('.home_review_slider').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					draggable: true,
					loop: true,
					arrows: false,
					autoplaySpeed: 3000,
					responsive: [
					  {
						breakpoint: 1000,
					  settings: {
						slidesToShow: 2,
						autoplay:true,
						slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 770,
					  settings: {
						slidesToShow: 1,
						autoplay:true,
						slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						slidesToShow: 1,
						autoplay:true,
						slidesToScroll: 1
					  }
					  }
					]
				  });
				} else {
				  // Destroy slick if initialized (optional safety)
				  if ($('.home_review_slider').hasClass('slick-initialized')) {
					$('.home_review_slider').slick('unslick');
				  }
			  
				  // Optional: ensure proper layout on desktop or non-home pages
				  $('.home_review_slider').addClass('no-slider');
				}
			  });
			  
				if($('.location_slider').length)
					{
						$('.location_slider').slick({
							slidesToShow: 2,           
							slidesToScroll: 1,
							centerMode: true,
							autoplay: false,
							autoplaySpeed: 5000,         
							//speed: 5000,               
							cssEase: 'linear',        
							infinite: true,
							arrows: true,            
							pauseOnHover: false,      
							pauseOnFocus: false,
							variableWidth: true,
							responsive: [
								{
								breakpoint: 1000,
								settings: {
									slidesToShow: 2,
									arrows: false, 
									slidesToScroll: 1
								}
								},
								{
								breakpoint: 770,
								settings: {
									slidesToShow: 1,
									variableWidth: false,
									autoplay: true,
									arrows: false, 
									arrows: false, 
									slidesToScroll: 1
								}
								},
								{
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									variableWidth: false,
									autoplay: true,
									arrows: false, 
									arrows: false, 
									slidesToScroll: 1
									
								}
								}
							]
							
							});
					}

	if($('.package_slider').length)
	{
		$('.package_slider').slick({
		    infinite: true,
		   	//centerMode: true,
		  	slidesToShow: 3,
			slidesToScroll: 1,
			loop: true,
		  	//autoplay: true,
		 	autoplaySpeed: 3000,
		 	responsive: [
			{
			  breakpoint: 1000,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 770,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		  ]
		});
	}
	if($('.membership_slider').length)
	{
		$('.membership_slider').slick({
		    infinite: true,
		   	//centerMode: true,
		  	slidesToShow: 3,
			slidesToScroll: 1,
			loop: true,
		  	//autoplay: true,
		 	autoplaySpeed: 3000,
		 	responsive: [
			{
			  breakpoint: 1000,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 770,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		  ]
		});
	}
	
	if($('.video-slider').length)
	{
		$('.video-slider').slick({
		    infinite: true,
		   	//centerMode: true,
		  	slidesToShow: 1,
			slidesToScroll: 1,
			loop: true,
			arrow:false,
			dots:true,
		  	//autoplay: true,
		 	autoplaySpeed: 3000,
		 	responsive: [
			{
			  breakpoint: 1000,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 770,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		  ]
		});
	}
	if($('.front_sliders').length)
	{
		$('.front_sliders').slick({
		    infinite: true,
		   	//centerMode: true,
		  	slidesToShow: 3,
			slidesToScroll: 1,
			loop: true,
		  	//autoplay: true,
		 	autoplaySpeed: 3000,
		 	responsive: [
			{
			  breakpoint: 1000,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 770,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		  ]
		});
	}
	if($('.related_slider').length)
	{
		$('.related_slider').slick({
		    infinite: true,
		   	//centerMode: true,
		  	slidesToShow: 3,
			slidesToScroll: 1,
			loop: true,
		  	//autoplay: true,
		 	autoplaySpeed: 3000,
		 	responsive: [
			{
			  breakpoint: 1000,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 770,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		  ]
		});
	}

});
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 260;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "View More >";
    var lesstext = "View Less ^";
    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent" ><span style="display:none">' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
 
    });
 	$(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
$(document).ready(function() {
	$(document).on('change','#currency_name',function(){
		var code = $(this).val();
		var baseUrl = $('#baseUrl').val();
		$.ajax({
			url: baseUrl+'/ajax/changecurrency',
			type: 'GET',
			dataType: 'json',
			data: {
				code: code,
			},
			success: function(response) {
				window.location.reload();
			},
			error: function(xhr, status, error) {
				
			}
		});
	})
	$(document).on('click','#boat-register', function() {
		var baseUrl = $('#baseUrl').val();
		$.ajax({
			url: baseUrl+'/ajax/getregisterboatform',
			type: 'GET',
			success: function(response) {
				if (response.success) {
					alert('dsf');
				} else {
					alert('dsf');
				}
			},
			error: function(xhr, status, error) {
				alert('dsf');
			}
		});
		$('#lrModal').modal(); 
	});
	$(document).on('change','#language', function() {
		var baseUrl = $('#baseUrl').val();
		var val = $(this).val();
		window.location.href = baseUrl + '/setlang/' +val;
	});	
	
	
	$(document).on('change','input[name="type[]"], input[name="equipment"], #rental_type, #Halfday, #Fullday, #Overnightstay, select[name="location"]', function() {
		$('#search-filter-fom').submit();
    });
	$(document).on('change', 'select[name="location"], select[name="type[]"], #rental_type', function() {
		$('#search-filter-mobile').submit();
    });
	$(document).on('click','#details-tabs li a', function() {
		$('#details-tabs li a').removeClass('active')
		$(this).addClass('active')
    });
	$(document).on('submit','#blog-comment', function(e) 
	{
		e.preventDefault();
		var baseUrl = $('#baseUrl').val();
		var formData = $(this).serialize();
		alert(formData);
		$.ajax({
			url: baseUrl + '/ajax/post-comment',  // Make sure this endpoint is correct
			type: 'POST',
			data: formData,
			dataType: 'json',
			success: function(response) {
				if (response.success) 
				{
					$('.alert').removeClass('alert-danger');
					$('.alert').removeClass('d-none');
					$('.alert').addClass(response.alert_class);
					$('.alert .message').html(response.message);
					setTimeout(function () {
						$('.alert').addClass('d-none');
					}, 4000);
				} 
				else 
				{
					$('.alert').removeClass('alert-success');
					$('.alert').removeClass('d-none');
					$('.alert').addClass(response.alert_class);
					$('.alert .message').html(response.message);
					setTimeout(function () {
						$('.alert').addClass('d-none');
					}, 4000);
				}
			},
			error: function(xhr, status, error) {
				console.log('Error:', error);  // Log the error for debugging
				$('#message').html('An error occurred while posting the comment.').css('color', 'red');
			}
		});
	});

	$('.people-plus').click(function() {
        let input = $('input[name="people"]');
        let currentVal = parseInt(input.val()) || 0;
        input.val(currentVal + 1);
		$('#search-filter-fom').submit();
    });

    // Minus button
    $('.people-minus').click(function() {
        let input = $('input[name="people"]');
        let currentVal = parseInt(input.val()) || 0;
        if (currentVal > 0) {
            input.val(currentVal - 1);
        }
		$('#search-filter-fom').submit();
    });

	$('.cabins-plus').click(function() {
        let input = $('input[name="cabins"]');
        let currentVal = parseInt(input.val()) || 0;
        input.val(currentVal + 1);
		$('#search-filter-fom').submit();
    });

    // Minus button
    $('.cabins-minus').click(function() {
        let input = $('input[name="cabins"]');
        let currentVal = parseInt(input.val()) || 0;
        if (currentVal > 0) {
            input.val(currentVal - 1);
        }
		$('#search-filter-fom').submit();
    });

	$('.berths-plus').click(function() {
        let input = $('input[name="berths"]');
        let currentVal = parseInt(input.val()) || 0;
        input.val(currentVal + 1);
		$('#search-filter-fom').submit();
    });

    // Minus button
    $('.berths-minus').click(function() {
        let input = $('input[name="berths"]');
        let currentVal = parseInt(input.val()) || 0;
        if (currentVal > 0) {
            input.val(currentVal - 1);
        }
		$('#search-filter-fom').submit();
    });
});





