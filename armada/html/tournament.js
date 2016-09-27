
$(function() {
$(".submit").click(function() {
	$('.success').fadeOut(200).hide();
	$('.error').fadeOut(200).hide();

	
	var date = $("#date").val();
	var a = $("#a").val();
	var v = $("#venue").val();
    var city = $("#city").val();
	var country = $("#country").val();
	var dataString = 'date='+date+'&a='+a+'&v='+v+'&city='+city+'&country='+country;


	if(date=='' || a=='0' || v=='')
	{
	$('.success').fadeOut(200).hide();
	$('.error').fadeOut(200).show();
	}
	else
	{
	$.ajax({
	type: "POST",
	url: "insertTournament.php",
	data: dataString,
	success: function(){
	$('.success').fadeIn(200).show();
	$('.error').fadeOut(200).hide();
	}
	});
	}
	return false;
	});
});