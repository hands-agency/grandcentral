<?php
/**
 * Send a mail
 * 
 * @package		Page
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class mail extends _items
{	
	
/**
 * Détermine en fonction du contexte quelle page afficher
 *
 * @access	public
 */
	public function send()
	{
	//	Use PHPmailer
		$mail = new PHPMailer;

		$mail->IsSMTP();            						// Set mailer to use SMTP
	//	$mail->IsQMAIL();           						// Set mailer to use QMAIL
		$mail->Host = 'ns0.ovh.net';						// Specify main and backup server
	//	$mail->Port='465'; 
		$mail->SMTPAuth = true;     						// Enable SMTP authentication
		$mail->Username = 'mvd@cafecentral.fr';  	// SMTP username
		$mail->Password = 'herrengasse'; 						// SMTP password
	//	$mail->SMTPSecure = 'tls';  						// Enable encryption, 'ssl' also accepted
		

		$mail->From = 'concierge@grandcentral.fr';
		$mail->FromName = 'Test de mail Grand Central';
		$mail->AddReplyTo('concierge@grandcentral.fr', 'Concierge Grand Central');
		
		$mail->AddAddress('mvd@cafecentral.fr', 'mvd CC');  // Add a recipient
	//	$mail->AddAddress('sf@cafecentral.fr', 'sf CC');  // Add a recipient
	//	$mail->AddCC('cc@example.com');
	//	$mail->AddBCC('bcc@example.com');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	//	$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//	$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->IsHTML(true);                                  // Set email format to HTML

		$mail->Subject = $this['title'];
		$mail->Body    = $this['descr'];
		$mail->AltBody = $this['altbody'];

	//	Confirm
		if(!$mail->Send())
		{
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		}
		else
		{	
		//	DEBUG
		//	sentinel::debug('Mail was sent!', $mail, 'OK', true);		
		//	Trigger event
			event::trigger($this, 'sent');
		}
	}
}
?>