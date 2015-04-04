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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */

/********************************************************************************************/
//	Get the data
/********************************************************************************************/
	$p = array(
		'order()' => 'created',
	);
//	Since
	if (isset($_GET['since'])) 
	{
		$p['created'] = '> '.$_GET['since'];	
	}
	$logbooks = i('logbook', $p, $_SESSION['pref']['handled_env']);

	/**
	 * Constructs the SSE data format and flushes that data to the client.
	 *
	 * @param string $id Timestamp/id of this connection.
	 * @param string $msg Line of text that should be transmitted.
	 */
	function sendMsg($id, $msg)
	{
		echo "id: $id" . PHP_EOL;
		echo "data: $msg" . PHP_EOL;
		echo PHP_EOL;
		ob_flush();
		flush();
	}

/********************************************************************************************/
//	Write logbooks
/********************************************************************************************/
	foreach ($logbooks as $logbook)
	{
	//	Label
		$author = i($logbook['subject'], $logbook['subjectid']->get());
		$icon = null;
	//	$item = i($logbook['item'], $logbook['itemid']->get());
	//	$label = $author['key'].' '.$logbook['key'].' '.$item['key'];
		$label = '<a href=\''.$author->edit().'\' class=\'user\'>'.$author['title'].'</a> '.cst('TIMELINE_EVENT_'.$logbook['key'], $logbook['key']).' <a>Something</a>';

	//	Message
		$msg = '{"id": "'.$logbook['id'].'", "event": "'.$logbook['key'].'", "label": "'.$label.'", "icon": "'.$icon.'"}';
	//	Send message
		sendMsg($logbook['id'], $msg);
	}
?>