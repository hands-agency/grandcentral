<?php
// use \Mailjet\Resources;
/**
 * Projects
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemMagworkflow extends _items
{
	protected $mailjet_key = 'aa0b1411e8782a230eacf814cb7ffca7';
	protected $mailjet_secret = '0b51abbbb6f4108746873f423677de41';

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

			$text = str_replace('&apos;','\'',htmlspecialchars_decode($mail['content']->get(), ENT_QUOTES));
			// create message data
			// $body = [
      //   'FromEmail' => $mail['fromemail']->get(),
      //   'FromName' => $mail['fromname']->get(),
      //   'Subject' => $mail['subject']->get(),
      //   'Html-part' => nl2br($text),
			// 	'TextPart' => $text,
      //   'Recipients' => []
      // ];
			// // destinataires
			// foreach ($mail['to']->unfold() as $to)
			// {
			// 	$body['Recipients'][] = array(
			// 		'Email' => $to['email']->get(),
			// 		'Name' => $to['title']->get(),
			// 	);
			// }
			// $mailjet = new \Mailjet\Client($this->mailjet_key, $this->mailjet_secret);
			// $response = $mailjet->post(Resources::$Email, ['body' => $body]);
			// // echo "<pre>";print_r($response);echo "</pre>";
			//
			// if ($response->success())
			// create message data
	    $params = array(
	      'method' => 'POST',
	      'from' => $mail['fromemail']->get(),
	      'subject' => $mail['subject']->get(),
	      'html' => nl2br($text),
	      'text' => $text,
				'to' => []
	    );
			foreach ($mail['to']->unfold() as $to)
			{
				$params['to'][] = $to['email']->get();
			}

	    $mailjet = new Mailjet($this->mailjet_key, $this->mailjet_secret);
	    $mailjet->sendEmail($params);

	    if ($mailjet->_response_code == 200)
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
