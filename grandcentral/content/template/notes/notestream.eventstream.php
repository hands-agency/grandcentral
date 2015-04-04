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
	if (isset($_GET['since'])) $p['created'] = '> '.$_GET['since'];
//	On a special item
	if (isset($_GET['item'])) $p['item'] = $_GET['item'];
	
//	Fetch !
	$notes = i('note', $p, $_SESSION['pref']['handled_env']);

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
		$created = new attrDate($note['created']);
		$attrs = array(
			'id' => null,
			'owner' => null,
		//	'owner_name' => i('human', $note['owner'])['title']->get(),
			'text' => null,
			'item' => null,
			'created' => $created->time_since(),
			'updated' => null,
		);
	//	Add attrs
		$msg = array();
		foreach ($attrs as $attr => $value) $msg[$attr] = (is_null($value)) ? $note[$attr]->get() : $value;
	//	Encode
		$json = json_encode($msg, true);
	//	And send
		sendMsg($note['id'], $json);
	}
?>