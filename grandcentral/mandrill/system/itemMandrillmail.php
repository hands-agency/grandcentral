<?php
 /**
  * The generic item of Grand Central
  *
  * @author	Sylvain Frigui <sf@hands.agency>
  * @access	public
  * @link		http://grandcentral.fr
  */
 class itemMandrillmail extends _items
 {
 	// public $to_email;
 	// public $to_name = 'undefined';
 /**
  * Class constructor (Don't forget it is an abstract class)
  *
  * @param	mixed  une id, une clé ou un tableau array('id' => 2)
  * @param	string  admin ou site (environnement courant par défaut)
  * @access	public
  */
 	public function __construct($env = env)
 	{
 		$env = 'site';
 		parent::__construct($env);
 	}

 	public function replace_text_with_data($datas)
 	{
 		$msg = (string) $this['content'];
 		preg_match_all("/\[([a-zA-Z0-9=&]+)\]/", $msg, $results, PREG_SET_ORDER);

 		foreach ((array) $results as $result)
 		{
 			if (isset($datas[$result[1]]))
 			{
 				$msg = str_replace($result[0], $datas[$result[1]], $msg);
 			}
 		}
 		//print'<pre>';print_r($msg);print'</pre>';
 		$this['content'] = $msg;
 	}

 	public function sendtohuman(itemHuman $human, array $datas = null)
 	{
 		if ($this->exists())
 		{
 		//Create a new PHPMailer instance
 			$mail = new PHPMailer();
 			$mail->CharSet = 'UTF-8';
 			$mail->isSendmail();
 		//Set who the message is to be sent from
 			$mail->setFrom($this['from'], $this['fromname']);
 		//Set an alternative reply-to address
 			$mail->addReplyTo($this['reply'], $this['replyname']);
 		//Set who the message is to be sent to
 			$mail->addAddress($human['key'], $human['title']);
 		//Set the subject line
 			$mail->Subject = $this['subject'];
 		//Read an HTML message body from an external file, convert referenced images to embedded,
 		//convert HTML into a basic plain-text alternative body
 			$txt = nl2br($this->replace_text_with_data($datas));

 			$mail->msgHTML($txt);

 			//send the message, check for errors
 			if (!$mail->send())
 			{
 			    $validation = "Mailer Error: " . $mail->ErrorInfo;
 			} else {
 			    $validation =  "Message sent!";
 			}
 		}
 		else
 		{
 			return false;
 		}
 	}

 	// public function send()
 	// {
 	// 	if ($this->exists())
 	// 	{
 	// 	//Create a new PHPMailer instance
 	// 		$mail = new PHPMailer();
 	// 		$mail->CharSet = 'UTF-8';
 	// 		$mail->isSendmail();
 	// 	//Set who the message is to be sent from
 	// 		$mail->setFrom($this['fromemail'], $this['fromname']);
 	// 	//Set an alternative reply-to address
 	// 		$mail->addReplyTo($this['fromemail'], $this['fromname']);
 	// 	//Set who the message is to be sent to
 	// 		$mail->addAddress($this['toemail'], $this['toname']);
 	// 	//Set the subject line
 	// 		$mail->Subject = htmlspecialchars_decode($this['subject'], ENT_HTML5);
 	// 	//Read an HTML message body from an external file, convert referenced images to embedded,
 	// 	//convert HTML into a basic plain-text alternative body
 	// 		$txt = nl2br(htmlspecialchars_decode((string) $this['content'], ENT_HTML5));

 	// 		$mail->msgHTML($txt);

 	// 		//send the message, check for errors
 	// 		if (!$mail->send())
 	// 		{
 	// 		    $validation = "Mailer Error: " . $mail->ErrorInfo;
 	// 		} else {
 	// 		    $validation =  "Message sent!";
 	// 		}
 	// 	}
 	// 	else
 	// 	{
 	// 		return false;
 	// 	}
 	// }
 	public function send()
 	{
 		if ($this->exists())
 		{
 			try
 			{
 				if (filter_var($this['toemail'], FILTER_VALIDATE_EMAIL))
 				{
 					$message = array(
 						'html' => $this['content']->get(),
 						'subject' => $this['subject']->get(),
 						'from_email' => $this['fromemail']->get(),
 						'from_name' => $this['fromname']->get(),
 						'to' => array(
 							array(
 								'email' => $this['toemail']->get(),
 								'name' => $this['toname']->get(),
 								'type' => 'to'
 							)
 						),
 						'headers' => array('Reply-To' => $this['fromemail']->get())
 					);
 					$async = false;
 					$mandrill = new Mandrill("YqZegK6yhGcafbkawdIX3Q");
 					$return = $mandrill->messages->send($message, $async);
 					return $return;
 				}
 			}
 			catch (Exception $e)
 			{
 				$l = array(
 					'What went wrong' => $e->getMessage(),
 					'function' => __METHOD__
 				);
 				sentinel::log(E_ERROR, $l);
 			}
 		}
 	}
 	public function prepare_text($data)
 	{
 		$from = array_keys($data);
 		$to = array_values($data);
 		$html = str_replace($from, $to, nl2br($this['content']->get()));
 		$this['content'] = $html;
 		return $this;
 	}
 }
 ?>
