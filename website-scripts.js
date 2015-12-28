var main = function(){
	/* Controls sliding back and forth of Encrypt/Decrypt forms
	*/

	$('#select-encrypt').click(function(){
		$('#body-decrypt').show();
		$('#body-decrypt').animate({left:"100%"},1000);
		$('#body-encrypt').animate({left:"0%"},1000);
		$('#body-decrypt').hide(10);
	});
	$('#select-decrypt').click(function(){
		$('#body-decrypt').hide();
		$('#body-decrypt').show(10);
		$('#body-encrypt').animate({left:"-100%"},1000);
		$('#body-decrypt').animate({left:"0%"},1000);
	});

	$('#encrypt-select').change(function(){
		$('#encrypt-preview').attr("src","baseImages/"+$('#encrypt-select').val());
	});

	$('#decrypt-select').change(function(){
		$('#decrypt-preview').attr("src","baseImages/"+$('#decrypt-select').val());
	});
};



$(document).ready(
		function(){
			$('#encrypt-preview').attr("src","baseImages/Preview.png");
			$('#decrypt-preview').attr("src","baseImages/Preview.png");
			/* 

			var originalHTML = $('.body-info').html();
			var toHTML = $('.body-info').html().replace(/\S/g,function(){
				return Math.round(Math.random());
			});
			$('.body-info').html(toHTML);
			var time = 10;
			var count = 100;
			for (var i=0; i < 100; i++){
				setTimeout(function(){
					var toHTML = $('.body-info').html().replace(/\S/g,function(){
						return Math.round(Math.random());
					});
					$('.body-info').html(toHTML);
									//alert('once');
				},time);
				time += 5;
			};
			setTimeout(function(){$('.body-info').html(originalHTML);},510);
			*/
			
		});
$(document).ready(main);