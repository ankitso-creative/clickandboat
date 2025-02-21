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
	if($('.boat_type_slider').length)
		{
			$('.boat_type_slider').slick({
				//infinite: true,
				  slidesToShow: 2,
				slidesToScroll: 1,
				autoplay: true,
				draggable: true,
				loop: true,
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
	if($('.location_slider').length)
	{
	$('.location_slider').slick({
			slidesToShow: 2,           
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 0,         
			speed: 10000,               
			cssEase: 'linear',        
			infinite: true,
			arrows: false,            
			pauseOnHover: false,      
			pauseOnFocus: false,
			variableWidth: true,
			
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
    var showChar = 400;  // How many characters are shown by default
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
	$(document).on('click','#boat-register', function() {
		$('#lrModal').modal('show');  // Opens the modal
	});
	
});


