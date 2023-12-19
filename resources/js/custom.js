

jQuery(document).ready(function($){

var cityArr = {'humboldt':'Humboldt', 'carson-city':'Carson City', 'churchill' : 'Churchill', 'clark':'Clark', 'douglas':'Douglas', 'elko':'Elko', 'esmeralda':'Esmeralda', 'eureka':'Eureka', 'lander':'Lander', 'lincoln':'Lincoln', 'lyon':'Lyon', 'mineral':'Mineral', 'nye':'NYe', 'pershing':'Pershing', 'storey':'Storey', 'washoe':'Washoe', 'white-pine':'White PINe' };
		
var pdfArr = {'humboldt':'Humboldt', 'carson-city':'Carson', 'churchill' : 'Churchill', 'clark':'Clark', 'douglas':'Douglas', 'elko':'Elko', 'esmeralda':'Esmeralda', 'eureka':'Eureka', 'lander':'Lander', 'lincoln':'Lincoln', 'lyon':'Lyon', 'mineral':'Mineral', 'nye':'Nye', 'pershing':'Pershing', 'storey':'Storey', 'washoe':'Washoe', 'white-pine':'White Pine' };

$(document).on('click', "#cityMap svg polygon, #cityMap svg path", function(){
    var name = $.trim($(this).attr("id"));
    if(typeof cityArr[name] == "undefined")
    {
        return false;
    }
    $("#cityMap svg polygon[fill=#1f5a7b]").attr('fill',"#CABFB5");
    $(this).attr('fill',"#1f5a7b");
    // $.redirect("statewide",
    // {
    //     city: cityArr[name],
    //     pdfName: pdfArr[name]
    // }, "POST", "");
});





if($("#cityMap").length > 0)
	{
		$(".overlay").show();
		$('#cityMap').load('city.svg', function(){
			$(".overlay").hide();
		});
	}



    if($("#detail-overview").length > 0)
	{
		var cityArr = {'humboldt':'Humboldt', 'carson-city':'Carson', 'churchill' : 'Churchill', 'clark':'Clark', 'douglas':'Douglas', 'elko':'Elko', 'esmeralda':'Esmeralda', 'eureka':'Eureka', 'lander':'Lander', 'lincoln':'Lincoln', 'lyon':'Lyon', 'mineral':'Mineral', 'nye':'Nye', 'pershing':'Pershing', 'storey':'Storey', 'washoe':'Washoe', 'white-pine':'White Pine' };
		
		$(document).on('click', "#cityMap svg polygon, #cityMap svg path", function(){
			
			if($(this).parent('g').hasClass('name-text'))
			{
				name = $(this).parent('g').attr("data-name");
				$("#cityMap svg polygon[id="+name+"]").trigger('click');
				return;
			}
			var name = $.trim($(this).attr("id"));
			if(typeof cityArr[name] == "undefined")
			{
				return false;
			}
			
			$("#cityMap svg polygon[fill=#1f5a7b]").attr('fill',"#CABFB5");
			$(this).attr('fill',"#1f5a7b");
			$("a#overviewPdf").attr('href', 'pdf/'+cityArr[name]+'.pdf');
			$("div#objPdfSpan").html('<embed id="objPdf" width="100%" height="481" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" alt="pdf" src="pdf/'+cityArr[name]+'.pdf#view=FitH">');
			$("span#cityPd").html(cityArr[name]);
			$("#pdfOver").html(cityArr[name]+" Overview");
		});
		
		$(document).on('click', ".reloads", function(){
			location.reload();
		});
	}

});