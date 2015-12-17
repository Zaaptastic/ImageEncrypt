var main = function(){
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
};


$(document).ready(main);