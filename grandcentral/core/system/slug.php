<?php
/**
 * Slugify a string
 *
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
class Slug
{
	public function __construct()
	{}

	function my_str_split($string)
	{
	   $slen=strlen($string);
	   for($i=0; $i<$slen; $i++)
	      $sArray[$i]=$string{$i};

	   return $sArray;
	}

	private function noDiacritics($string)
	{
		$accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array('«&nbsp;' => ' ','&nbsp;»' => ' ','&nbsp;' => ' ','«' => '','»' => '', '&' => ' ', "'" => '','’'=>' ','°'=>' ');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
		$string = str_replace('nbsp','',$string);
    return $string;
	}

	public function makeSlugs($string, $maxlen=null)
	{
		$newStringTab=array();
		$tab = null ;
	  $stringTab = str_split(mb_strtolower($this->noDiacritics($string)));
	  $authorizedArray=array_merge(range('a', 'z'), array('0','1','2','3','4','5','6','7','8','9','-','.'));
	  foreach($stringTab as $letter)
	    if(in_array($letter, $authorizedArray))
			{
				$tab=$letter;
				$newStringTab[] = $tab ;
			}
	    else if($tab != '-')
			{
				$tab='-';
				$newStringTab[] = $tab ;
			}

	   if(count($newStringTab))
	   {
	      $newString=implode($newStringTab);
	      if(!is_null($maxlen))
	         $newString=mb_substr($newString, 0, $maxlen);
	   }
	   else
	      $newString='';


		$newString = str_replace(array('--','---'), '-', $newString);
		$return = mb_substr($newString,-1) == '-' ? mb_substr($newString,0,-1) : $newString;
	   return rawurlencode($return);
	}


	public function checkSlug($sSlug)
	{
	   return preg_match("/^[a-zA-Z0-9]+[a-zA-Z0-9\_\-]*$/", $sSlug);
	}
}
?>
