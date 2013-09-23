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
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class markup
{

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	private
 */
	public function __construct()
	{
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	private
 */
	public static function tag($tag)
	{
	//	Our return
		$return = null;

	//	AlwaysInArray
		$tag = (array) $tag;
		
	//	Here: our tags
	#	sentinel::debug(__FUNCTION__.'() in '.__FILE__.' line '.__LINE__, $tag);
		
		if ($tag)
		{	
		//	Loop through the tags
			foreach($tag as $tag)
			{
			//	The Content
				if (isset($tag['html'])) $content = $tag['html'];
				else $content = null;
			//	Is closing tag
				if (method_exists('html', 'is_closingtag')) $IsClosingTag = html::is_closingtag($tag['tag']);
				else $IsClosingTag = true;
			//	Encapsulate
				if ($IsClosingTag) $return.= '<'.$tag['tag'].self::unfold_attr($tag).'>'.$content.'</'.$tag['tag'].'>';
				else $return.= '<'.$tag['tag'].self::unfold_attr($tag).' />';
			}
			
		//	Return
			return $return;
		}
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	private
 */
	public static function unfold_attr($attr, $evalues=null)
	{
	//	Our return
		$return = null;
		
	//	Here: our attributes
	#	sentinel::debug(__FUNCTION__.'() in '.__FILE__.' line '.__LINE__, $attr);
	
	//	Skip those attributes
		$skip = array('tag', 'html');
	
	//	Loop through the attributes
		foreach((array) $attr as $attr => $value)
		{
		//	If there's a value
			if (!empty($value) && !is_array($value) && !in_array($attr, $skip))
			{
			//	Evaluate the value
				if ($evalues) $value = evaluate($value, $evalues);
				$return .= ' '.$attr.'="'.trim($value).'"';
			}
		}
	//	Return
		return $return;
	}
}
?>