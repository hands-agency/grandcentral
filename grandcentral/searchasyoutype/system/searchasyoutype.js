/*********************************************************************************************
/**	* Search as you type
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{	
//	Plugin
	$.fn.searchasyoutype = function(param, target, callback)
	{
	//	Some vars
		var timing = 500;
		var timeout;

	//	On key up...
		this.keyup(function()
		{
		//	Some vars
			$search = $(this);
			
		//	Stop current action
			clearTimeout(timeout);
			
		//	Start a new one
			timeout = setTimeout(function()
			{
			//	Add the typed value to the params	
				param['q'] = $search.val();
			//	Refresh the target
			  	$(target).ajx(param, callback,
				{
				//	Debug
					debug:false,
				});
			}, timing);
		});
	}
})( jQuery );
	