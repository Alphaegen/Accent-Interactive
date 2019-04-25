$(function() {

    $('#activate-form-link').click(function(e) {
  		$("#activate-form").delay(100).fadeIn(100);
   		$("#register-form").fadeOut(100);
  		$('#register-form-link').removeClass('active');
  		$(this).addClass('active');
  		e.preventDefault();
  	});

	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#activate-form").fadeOut(100);
		$('#activate-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});


  $('.users-btn').click(function(e) {
    $(".userpage").delay(100).fadeIn(100);
    $(".orderPage").fadeOut(100);
    $(".eventPage").fadeOut(100);
    $('.orders-btn').removeClass('active');
    $('.events-btn').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

$('.events-btn').click(function(e) {
  $(".eventPage").delay(100).fadeIn(100);
  $(".orderPage").fadeOut(100);
  $(".userpage").fadeOut(100);
  $('.orders-btn').removeClass('active');
  $('.users-btn').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

$('.orders-btn').click(function(e) {
  $(".orderPage").delay(100).fadeIn(100);
  $(".userpage").fadeOut(100);
  $(".eventPage").fadeOut(100);
  $('.users-btn').removeClass('active');
  $('.events-btn').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});
});


function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,})?$/;
  	return emailReg.test( $email );
}
