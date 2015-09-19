<?php 

class MinifyHTML{

	public $regex_html = '/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s';
	public $spaces = array(
		"\r\n", 
		"\r", 
		"\n", 
		"\t"
	);

	public function __construct()
	{

	}

	function minify( $html ) {
	 
	   // Suppression des commentaires HTML, 
	   // sauf les commentaires conditionnels pour IE
	   $html = preg_replace($this->regex_html, '', $html);
	 
	   // Suppression des espaces vides
	   $html = str_replace($this->spaces, '', $html);
	   while ( stristr($html, '  ')) 
	       $html = str_replace('  ', ' ', $html);
	   return $html;
	}
}
 ?>