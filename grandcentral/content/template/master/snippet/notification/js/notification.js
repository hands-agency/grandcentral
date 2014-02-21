//	check for browser support
	if(typeof(EventSource)!=="undefined")
	{
	//	create an object, passing it the name and location of the server side script
		var source = new EventSource('ajax.html?ajax=page.default.eventstream');
	//	detect message receipt
		source.onmessage = function(event)
		{
			$('#eventstream').html(event.data);
		};
	}
	else {}
	alert('er');