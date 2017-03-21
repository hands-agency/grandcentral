<?php
/**
 * Projects
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemMagworkflow extends _items
{
	protected $mandrill = 'OyDD7MicNLXoEvx3G259Uw';
/**
 * Execute the workflow
 *
 * @access  public
 */
	public function get_status()
	{
		return $this['itemstatus']->get();
	}
/**
 * Execute the workflow
 *
 * @access  public
 */
	public function process(itemMagazine $magazine)
	{
		// envois des mails
		if (!$this['mailtosend']->is_empty())
		{
			foreach ($this['mailtosend']->unfold() as $mail)
			{
				$this->sendmail($mail, $magazine);
			}
		}

	}
/**
 * Send a mail via Mandrill
 *
 * @access  public
 */
	public function sendmail(itemMandrillmail $mail, itemMagazine $magazine)
	{
		if (!$mail['to']->is_empty())
		{
			$mail->replace_text_with_data(array('link' => $magazine->get_source()));
			// create message data
			$message = array(
				'html' => nl2br(htmlspecialchars_decode((string) $mail['content'], ENT_QUOTES)),
				// 'html' => nl2br((string) $mail['content']),
				// 'text' => 'Example text content',
				'subject' => $mail['subject']->get(),
				'from_email' => $mail['fromemail']->get(),
				'from_name' => $mail['fromname']->get(),
				'to' => array(),
				'headers' => array('Reply-To' => $mail['fromemail']->get()),
			);
			// echo "<pre>";print_r($message);echo "</pre>";
			// destinataires
			foreach ($mail['to']->unfold() as $to)
			{
				$message['to'][] = array(
					'email' => $to['email']->get(),
					'name' => $to['title']->get(),
					'type' => 'to'
				);
			}
			$async = false;
			// print'<pre>';print_r($message);print'</pre>';
			$mandrill = new Mandrill($this->mandrill);
			$r = $mandrill->messages->send($message, $async);
			// $r = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async);
			// print'<pre>';print_r($r);print'</pre>';exit;
			if (isset($r[0]) && $r[0]['status'] == 'sent')
			{
				$return = array(
					'success' => true
				);
			}
			else
			{
				$return = array(
					'success' => false
				);
			}
		}
	}
}
?>
