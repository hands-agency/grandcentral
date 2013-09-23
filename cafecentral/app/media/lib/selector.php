<?php
/**
 * Media Selector Library
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */

/**
 * Media selector
 *
 * @param	string	path to the file (root is the media directory)
 * @return	object	a media object
 * @access	public
 */
	function media($path)
	{
		$media = new media($path);
		switch ($media->get_mime())
		{
		//	image
			case 'image/gif':
			case 'image/jpeg':
			case 'image/png':
				$media = new image($path);
				break;
		}
		
		return $media;
	}
?>