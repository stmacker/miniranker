
$(function() {
$(".submit").click(function() {
	$('.success').fadeOut(200).hide();
	$('.error').fadeOut(200).hide();

	var t = $("#t").val();
	var p = $("#placing").val();
	var s = $("#s").val();
    
	var p1 = $("#p1").val();
	var p1copies = $("#p1copies").val();
	
    var p2 = $("#p2").val();
	var p2copies = $("#p2copies").val();
	 
	var p3 = $("#p3").val();
	var p3copies = $("#p3copies").val();

    	var p4 = $("#p4").val();
	var p4copies = $("#p4copies").val();
	
    	var p5 = $("#p5").val();
	var p5copies = $("#p5copies").val();
	
    	var p6 = $("#p6").val();
	var p6copies = $("#p6copies").val();
	
	var p7 = $("#p7").val();
	var p7copies = $("#p7copies").val();
		
	var p8 = $("#p8").val();
	var p8copies = $("#p8copies").val();

	var p9 = $("#p9").val();
	var p9copies = $("#p9copies").val();

	var p0 = $("#p0").val();
	var p0copies = $("#p0copies").val();

	
	var dataString = 't='+t+'&p='+p+'&s='+s+
	'&p1='+p1+'&p1copies='+p1copies+
	'&p2='+p2+'&p2copies='+p2copies+
	'&p3='+p3+'&p3copies='+p3copies+
	'&p4='+p4+'&p4copies='+p4copies+
	'&p5='+p5+'&p5copies='+p5copies+
	'&p6='+p6+'&p6copies='+p6copies+
	'&p7='+p7+'&p7copies='+p7copies+
	'&p8='+p8+'&p8copies='+p8copies+
	'&p9='+p9+'&p9copies='+p9copies+
	'&p0='+p0+'&p0copies='+p0copies;


	if(t=='' || p=='0' || (s=='' && p1==''))
	{
	$('.success').fadeOut(200).hide();
	$('.error').fadeOut(200).show();
	}
	else
	{
	$.ajax({
	type: "POST",
	url: "insertPlacing.php",
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