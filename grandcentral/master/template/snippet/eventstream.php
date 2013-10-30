<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 * 
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Bind scripts & css files
/********************************************************************************************/
	$_APP->bind_file('css', 'css/eventstream.css');
	$_APP->bind_file('script', 'js/eventstream.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Only recent logs
	$since = 5; //mn
//	Only limited amount of items
	$maxItems = 5;

/********************************************************************************************/
//	Event Source
/********************************************************************************************/
	if (isset($_GET['item']))
	{
		$EventSource = cc('page', 'api.eventstream')['url']->args(array
		(
			'app' => 'master',
			'template' => 'eventstream',
			'item' => $_GET['item'],
		));

	//	Bind script
		$script = "
			$.sse(
			{
				source:'".$EventSource."',
				datetime:'".date('Y-m-d H:i:s')."',
				delay:'".$since."',
				onMessage:function(e)
				{
				//	Get the data
					data = JSON.parse(e.data);
					item = data['item']+'_'+data['itemid'];
				
				//	Whose data is it?
					if (data['subject'] == 'human' && data['subjectid'] == ".$_SESSION["user"]["id"]." ) whose = 'mine';
					else whose = 'everybodyelses';
					ul = $('#eventstream ul.'+whose);
				
				//	Ensure the items get loaded just one time;
					old = $('#eventstream li[data-item='+item+']');
					if (old.length != 0) old.stop().hide('fast', function(){\$(this).remove();});

				//	Add the new line
					li = '<li data-item=\"'+item+'\" style=\"display:none;opacity:'+data['opacity']+'\"><a href=\"'+data['editauthor']+'\">'+data['author']+'</a> <span>'+data['event']+'</span> <a href=\"'+data['edit']+'\">'+data['title']+'</a> <span>'+data['timeSince']+'</span> <a href=\"\" class=\"undo\">Undo</a><a href=\"\" class=\"compare\">What\'s new?</a></li>';
					$(li).prependTo(ul).show('fast').fadeTo(300000, 0.3, function() {\$(this).hide('fast', function(){\$(this).remove()})});

				//	No more than
					max = ".$maxItems.";
					if (ul.find('li').length > max) ul.find('li:last').remove();
				}
			});
		";
		$_APP->bind_file('script', $script);
	}
?>