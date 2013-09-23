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
		var stop = null;
		var timing = 400;

	//	On key up...
		this.keyup(function()
		{
			$search = $(this);
			setTimeout(function()
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
	