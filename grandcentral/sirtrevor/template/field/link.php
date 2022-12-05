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
//	Some bind
/********************************************************************************************/
	$_APP->bind_css('field/css/link.css');
	$_APP->bind_script('field/js/link.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$defaultPanel = 'internal';
	$currentLink = isset($_POST['link']) ? $_POST['link'] : null;
//	Iframe Link (Worst.Method.Ever)
	$iframeLink = '/grandcentral/sirtrevor/template/field/link.html';
	$iframeMailto = '/grandcentral/sirtrevor/template/field/link.mailto.html';
	$iframeTelephone = '/grandcentral/sirtrevor/template/field/link.telephone.html';

/********************************************************************************************/
//	Get some work done
/********************************************************************************************/
//	Can we guess the current link type ?
	if ($currentLink)
	{
		switch (true)
		{
			//	Internal link
			case $currentLink{0} == '[' :
				$currentLinkType = 'internal';
				break;
			//	Media
			case mb_strstr($currentLink, app('media')->get_templateurl('site')) :
				$currentLinkType = 'media';
				break;
			//	Mailto
			case mb_substr($currentLink, 0, 6) == 'mailto' :
				$currentLinkType = 'mailto';
				break;
			//	Telephone
			case mb_substr($currentLink, 0, 1) == '0' :
				$currentLinkType = 'telephone';
				break;
			//	External link
			default:
				$currentLinkType = 'external';
				break;
		}
	}

//	Get the things you can link to
	$items = i('item', array(
		'hasurl' => true,
	//	'order()' => 'title',
	), 'site');

//	Save pref and open the last panel
	$panel = (isset($_SESSION['user']['pref']['sirtrevor']['link'])) ? $_SESSION['user']['pref']['sirtrevor']['link'] : $defaultPanel;
	// $_APP->bind_code('script', '
	// 	$(\'.adminContext .tabs li[data-tab="'.$panel.'"]\').trigger(\'mousedown\');
	// ');
?>
