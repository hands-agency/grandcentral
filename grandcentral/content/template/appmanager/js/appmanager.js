/*********************************************************************************************
/**	* Add a method to the greenbutton plugin
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#greenbutton').data('greenbutton').buildapp = function()
	{
	//	Go to the Build app page
		document.location.href = ADMIN_URL+'/build-an-app';
	}