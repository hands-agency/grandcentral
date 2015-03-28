/*********************************************************************************************
/**	* Server-side events handy jQuery plugin
* 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{
//	Plugin
	$.sse = function(param)
	{
	//	Some vars
		var url = param['source'];
		var source = '';
		var refresh = false;
		var since = '&since=';
		var datetime = param['datetime'];
		if (param['delay']) var delay = '&delay='+param['delay'];
		else var delay = '';

	//	Connect to source
		function connect()
		{
		//	The source
			sourceUrl = url+since+datetime+delay;
			source = new EventSource(sourceUrl);
			
		//	DEBUG
		//	console.log(sourceUrl);

		//	Listen to event source
			source.addEventListener('message', function(e)
			{
			//	If there's an event
				if (e.data)
				{
					data = JSON.parse(e.data);
				//	onMessage
					param['onMessage'](e);
				//	Store a new datetime
					data = JSON.parse(e.data);
					datetime = data['updated'];
					refresh = true;
				}
			}, false);

		//	Connexion open
			source.addEventListener('open', function(e)
			{
			//	console.log('Open');
			}, false);

		//	Connexion close
			source.addEventListener('error', function(e)
			{
			//	Listen to a fresh stream	
				if (refresh === true)
				{
					refresh = false;
					delay = '';
				//	Reset connection (DOESNT WORK, SO HAD TO COMMENT CONNECT() TO AVOID LOOP CONNECTIONS...)
					source.close();
					connect();
				};
				if (e.readyState == EventSource.CLOSED)
				{
				//	console.log('Connection was closed');
				}
			}, false);
		}

	//	Launch event source
		if (!!window.EventSource)
		{
			connect(param['datetime']);
		}
		else {
		  // Result to xhr polling :(
		}
	};
})( jQuery );