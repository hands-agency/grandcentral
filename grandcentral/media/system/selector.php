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
	function media($file)
	{
		
		$appMedia = new app('media');
		$root = $appMedia->get_templateroot();
		$media = new file($root.$file);
		
		switch ($media->get_mime())
		{
		//	image
			case 'image/gif':
			case 'image/jpeg':
			case 'image/pjpeg':
			case 'image/png':
			case 'image/svg+xml':
			case 'image/tiff':
				$media = new image($media->get_root());
				break;
		//	video
			case 'video/mpeg':
			case 'video/mp4':
			case 'video/ogg':
			case 'video/quicktime':
			case 'video/webm':
			case 'video/x-matroska':
			case 'video/x-ms-wmv':
			case 'video/x-flv':
				$media = new video($media->get_root());
				break;
		}
		
		return $media;
	}
?>