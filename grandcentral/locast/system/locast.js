/*********************************************************************************************
/**	* Talk to the Locast API
* 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Plugin
	$.locast = function(param)
	{	
	//	Some vars
		url = param['url'];
		
	//	Go get it
		$.ajax(
		{
			url: url,
			dataType: 'json'
		})
		.done(function(data)
		{
			console.log('locast app debug');
			console.log(data);
		});
	};
})( jQuery );