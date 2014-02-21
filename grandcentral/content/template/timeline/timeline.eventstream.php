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
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
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
	$logbooks = cc('logbook', $p, $_SESSION['pref']['handled_env']);

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
	//	Author
		$author = cc($logbook['subject'], $logbook['subjectid'])['title'];
	//	Message
		$msg = '{"id": "'.$logbook['id'].'", "event": "'.$logbook['key'].'", "author": "'.$author.'", "item": "'.$logbook['item'].'", "itemid": "'.$logbook['itemid'].'"}';
	//	Send message
		sendMsg($logbook['id'], $msg);
	}
?>