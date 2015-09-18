/*********************************************************************************************
/**	* Add a method to the greenbutton plugin
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#greenbutton').data('greenbutton').buildapp = function()
	{
	//	Go to the Build app page
		document.location.href = ADMIN_URL+'/build-an-app';
	}

/*********************************************************************************************
/**	* Focus on search engine
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#refine input').focus();
	$('#refine input').searchasyoutype(
	{
		app:'content',
		template:'/appmanager/appmanager',
		target:'#adminContent section.active',
	});