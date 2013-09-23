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
//	Get the data
/********************************************************************************************/
	$p = array(
		'order()' => 'created',
	);
//	Since
	if (isset($_GET['since'])) $p['created'] = '> '.$_GET['since'];
//	On a special item
	if (isset($_GET['item'])) $p['item'] = $_GET['item'];
	if (isset($_GET['itemid'])) $p['itemid'] = $_GET['itemid'];
	
//	Fetch !
	$notes = cc('note', $p, $_SESSION['pref']['handled_env']);

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
//	Write notes
/********************************************************************************************/
	foreach ($notes as $note)
	{
	//	Attrs to be passed
		$created = new date($note['created']);
		$attrs = array(
			'id' => null,
			'author' => null,
			'author_link' => 'http://www.link.com',
			'author_name' => 'Michael, remember to do this.',
			'descr' => null,
			'item' => null,
			'itemid' => null,
			'created' => $created->time_since(),
			'updated' => null,
		);
	//	Add attrs
		$msg = array();
		foreach ($attrs as $attr => $value) $msg[$attr] = (is_null($value)) ? $note[$attr] : $value;
	//	Encode
		$json = json_encode($msg, true);
	//	And send
		sendMsg($note['id'], $json);
	}
?>