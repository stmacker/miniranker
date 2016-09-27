
$(function() {
$(".submit").click(function() {
	$('.success').fadeOut(200).hide();
	$('.error').fadeOut(200).hide();

	var t = $("#t").val();
	var p = $("#placing").val();
	var s = $("#s").val();
    
	var p1 = $("#p1").val();
	var p1copies = $("#p1copies").val();
	var p1u1 = $("#p1u1").val();
	var p1u2 = $("#p1u2").val();
	var p1u3 = $("#p1u3").val();
	var p1u4 = $("#p1u4").val();
	var p1u5 = $("#p1u5").val();
	var p1u6 = $("#p1u6").val();
	var p1u7 = $("#p1u7").val();
	var p1u8 = $("#p1u8").val();
	
    var p2 = $("#p2").val();
	var p2copies = $("#p2copies").val();
	var p2u1 = $("#p2u1").val();
	var p2u2 = $("#p2u2").val();
	var p2u3 = $("#p2u3").val();
	var p2u4 = $("#p2u4").val();
	var p2u5 = $("#p2u5").val();
	var p2u6 = $("#p2u6").val();
	var p2u7 = $("#p2u7").val();
	var p2u8 = $("#p2u8").val();
	 
	var p3 = $("#p3").val();
	var p3copies = $("#p3copies").val();
	var p3u1 = $("#p3u1").val();
	var p3u2 = $("#p3u2").val();
	var p3u3 = $("#p3u3").val();
	var p3u4 = $("#p3u4").val();
	var p3u5 = $("#p3u5").val();
	var p3u6 = $("#p3u6").val();
	var p3u7 = $("#p3u7").val();
	var p3u8 = $("#p3u8").val();
	
    var p4 = $("#p4").val();
	var p4copies = $("#p4copies").val();
	var p4u1 = $("#p4u1").val();
	var p4u2 = $("#p4u2").val();
	var p4u3 = $("#p4u3").val();
	var p4u4 = $("#p4u4").val();
	var p4u5 = $("#p4u5").val();
	var p4u6 = $("#p4u6").val();
	var p4u7 = $("#p4u7").val();
	var p4u8 = $("#p4u8").val();
	
    var p5 = $("#p5").val();
	var p5copies = $("#p5copies").val();
	var p5u1 = $("#p5u1").val();
	var p5u2 = $("#p5u2").val();
	var p5u3 = $("#p5u3").val();
	var p5u4 = $("#p5u4").val();
	var p5u5 = $("#p5u5").val();
	var p5u6 = $("#p5u6").val();
	var p5u7 = $("#p5u7").val();
	var p5u8 = $("#p5u8").val();
	
    var p6 = $("#p6").val();
	var p6copies = $("#p6copies").val();
	var p6u1 = $("#p6u1").val();
	var p6u2 = $("#p6u2").val();
	var p6u3 = $("#p6u3").val();
	var p6u4 = $("#p6u4").val();
	var p6u5 = $("#p6u5").val();
	var p6u6 = $("#p6u6").val();
	var p6u7 = $("#p6u7").val();
	var p6u8 = $("#p6u8").val();
	
	var p7 = $("#p7").val();
	var p7copies = $("#p7copies").val();
	var p7u1 = $("#p7u1").val();
	var p7u2 = $("#p7u2").val();
	var p7u3 = $("#p7u3").val();
	var p7u4 = $("#p7u4").val();
	var p7u5 = $("#p7u5").val();
	var p7u6 = $("#p7u6").val();
	var p7u7 = $("#p7u7").val();
	var p7u8 = $("#p7u8").val();
	
	var p8 = $("#p8").val();
	var p8copies = $("#p8copies").val();
	var p8u1 = $("#p8u1").val();
	var p8u2 = $("#p8u2").val();
	var p8u3 = $("#p8u3").val();
	var p8u4 = $("#p8u4").val();
	var p8u5 = $("#p8u5").val();
	var p8u6 = $("#p8u6").val();
	var p8u7 = $("#p8u7").val();
	var p8u8 = $("#p8u8").val();
	
	var dataString = 't='+t+'&p='+p+'&s='+s+
	'&p1='+p1+'&p1copies='+p1copies+'&p1u1='+p1u1+'&p1u2='+p1u2+'&p1u3='+p1u3+'&p1u4='+p1u4+'&p1u5='+p1u5+'&p1u6='+p1u6+'&p1u7='+p1u7+'&p1u8='+p1u8+
	'&p2='+p2+'&p2copies='+p2copies+'&p2u1='+p2u1+'&p2u2='+p2u2+'&p2u3='+p2u3+'&p2u4='+p2u4+'&p2u5='+p2u5+'&p2u6='+p2u6+'&p2u7='+p2u7+'&p2u8='+p2u8+
	'&p3='+p3+'&p3copies='+p3copies+'&p3u1='+p3u1+'&p3u2='+p3u2+'&p3u3='+p3u3+'&p3u4='+p3u4+'&p3u5='+p3u5+'&p3u6='+p3u6+'&p3u7='+p3u7+'&p3u8='+p3u8+
	'&p4='+p4+'&p4copies='+p4copies+'&p4u1='+p4u1+'&p4u2='+p4u2+'&p4u3='+p4u3+'&p4u4='+p4u4+'&p4u5='+p4u5+'&p4u6='+p4u6+'&p4u7='+p4u7+'&p4u8='+p4u8+
	'&p5='+p5+'&p5copies='+p5copies+'&p5u1='+p5u1+'&p5u2='+p5u2+'&p5u3='+p5u3+'&p5u4='+p5u4+'&p5u5='+p5u5+'&p5u6='+p5u6+'&p5u7='+p5u7+'&p5u8='+p5u8+
	'&p6='+p6+'&p6copies='+p6copies+'&p6u1='+p6u1+'&p6u2='+p6u2+'&p6u3='+p6u3+'&p6u4='+p6u4+'&p6u5='+p6u5+'&p6u6='+p6u6+'&p6u7='+p6u7+'&p6u8='+p6u8+
	'&p7='+p7+'&p7copies='+p7copies+'&p7u1='+p7u1+'&p7u2='+p7u2+'&p7u3='+p7u3+'&p7u4='+p7u4+'&p7u5='+p7u5+'&p7u6='+p7u6+'&p7u7='+p7u7+'&p7u8='+p7u8+
	'&p8='+p8+'&p8copies='+p8copies+'&p8u1='+p8u1+'&p8u2='+p8u2+'&p8u3='+p8u3+'&p8u4='+p8u4+'&p8u5='+p8u5+'&p8u6='+p8u6+'&p8u7='+p8u7+'&p8u8='+p8u8;


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