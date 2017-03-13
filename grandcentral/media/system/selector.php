<?php
/**
 * Media Selector Library
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */

/**
 * media() lets you simply handle media files
 * <pre>
 * // Load jQuery, Sir Trevor and Masonry 
 * media('image/logo.png');
 * </pre>
 *
 * @param	string	path to the file (root is the media directory)
 * @return	object	a media object
 * @access	public
 */
	function media($file)
	{
		$appMedia = app('media');
		$root = $appMedia->get_templateroot('site');
	//	Accept media with the full serveur root
		if (strstr((string) $file, $root)) $root = null;
		$file = (mb_strpos($file, '/') === 0) ? $file : '/'.$file;
		$media = new media($root.$file);
		// print '<fieldset class="debug"><legend>'.__FUNCTION__.'() in '.__FILE__.' line '.__LINE__.'</legend><pre>';print_r($media);print'</pre></fieldset>';
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