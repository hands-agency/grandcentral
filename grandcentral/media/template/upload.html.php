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
//	Some vars
/********************************************************************************************/
	$return = array();
	$returnImg = array();

/********************************************************************************************/
//	Upload files
/********************************************************************************************/
//	Only admins ca post
	if ($_SESSION['user']->is_admin())
	{
	//	Build path
		$path = app('media')->get_templateroot('site').'/';
	//	Add user folder
		if (isset($_POST['folder'])) $path = str_replace('//', '/', $path.$_POST['folder'].'/');

	//	Loop through received files
		foreach($_FILES as $id => $file)
		{
		//	Complete path
			$slug = new slug();
			$thefilename = $slug->makeSlugs($file['name']);

			$filePath = $path.$thefilename;
		//	Move file
			if (move_uploaded_file($file['tmp_name'], $filePath))
			{
				chmod($filePath, 0755);
				
				$return['meta'] = array(
					'msg' => 'All good',
				);
				$returnImg[] = array(
					'path' => $_POST['folder'].'/'.$thefilename,
					'url' => media($filePath)->get_url(),
					'name' => $thefilename
				);
			}
		//	Works not
			else
			{
				$return['meta'] = array('msg' => 'Sorry, can\'t upload '.$file['tmp_name'].' into '.$filePath);
			}
		}

	//	Return
		if (!empty($returnImg))
		{
			$return['data'] = array(
				'file' => $returnImg
			);
		}
	}
//	Not an admin?
	else
	{
		$return['meta'] = array(
			'msg' => 'Sorry, only admins can post here',
		);
	}

//	Return code
	echo json_encode($return);
?>
