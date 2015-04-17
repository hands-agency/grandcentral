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
//	Value template
	$valueTemplate = (isset($_POST['valueTemplate'])) ? $_POST['valueTemplate'] : null;
//	Value param
	parse_str(urldecode($_POST['name']), $name);
	$form = key($name);
	$field = key($name[$form]);
	$valueParam = array();
	if (isset($_POST['valueParam']))
	{
		$pattern = '/'.str_replace(array('[',']'), array('\[','\]'),$_POST['name']).'\[param\](\[([a-zA-Z0-9_\-]*)\])(\[([a-zA-Z0-9_\-]*)\])?(\[([a-zA-Z0-9_\-]*)\])?$/';
		foreach ($_POST['valueParam'] as $param)
		{
			
			preg_match($pattern, $param['name'], $matches);
			if (isset($matches[6]))
			{
				// print'<pre>';print_r($matches[4]);print'</pre>';
				if (empty($matches[6]))
				{
					$valueParam[$matches[2]][$matches[4]][] = $param['value'];
				}
				else
				{
					$valueParam[$matches[2]][$matches[4]][$matches[6]] = $param['value'];
				}
			}
			elseif (isset($matches[4]))
			{
				// print'<pre>';print_r($matches[4]);print'</pre>';
				if (empty($matches[4]))
				{
					$valueParam[$matches[2]][] = $param['value'];
				}
				else
				{
					$valueParam[$matches[2]][$matches[4]] = $param['value'];
				}
			}
			else
			{
				$valueParam[$matches[2]] = $param['value'];
			}
			
		}
	}
	$app = app($_POST['valueApp'], null, $valueParam);

//	Content-type
	$valueContenttype = (isset($_POST['valueContenttype'])) ? $_POST['valueContenttype'] : null;
	
/********************************************************************************************/
//	Template list
/********************************************************************************************/
//	Check if the app has some templates
	$templates = $app->get_templates($valueContenttype, $_POST['env']);
	#sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $templates);
	if ($templates)
	{
	//	We need templates, not indexes
		foreach ($templates as $template) $tmp[$template] = $template;
		$templates = $tmp;
		
		$fparams = array(
			'values' => $templates,
			'valuestype' => 'array',
			'value' => $valueTemplate,
			'placeholder' => '...'
		);
		$fieldTemplate = new fieldSelect($_POST['name'].'[template]', $fparams);
	}

/********************************************************************************************/
//	FROM APP.PARAM Champ paramètres des apps
/********************************************************************************************/	
//	récupération des paramètres de l'app
	$params = $app->get_default_param();
	// print'<pre>';print_r($params);print'</pre>';exit;
	// print '<pre>';print_r($APP);print'</pre>';
	$fields = array();
		// print'<pre>valueparam : ';print_r($valueParam);print'</pre>';
//	construction de la liste des champs
	foreach ((array) $params as $key => $value)
	{
	//	recherche de la valeur sélectionnée
		preg_match('/\[([a-z_0-9]*)\]/i', $value, $matches);
	//	suppression des caractères inutiles
		$value = str_replace(array(' ','[', ']'), '', $value);
	//	création des listes
		$values = explode(',', $value);
		//print'<pre>value : ';print_r($value);print'</pre>';
		// $value = 
	//	champ text et number
		if (count($values) == 1)
		{
			$p = array(
				'label' => $key,
				'value' => $value
			);
		//	number
			if (is_numeric($value)) $field = new fieldNumber($key, $p);
		//	text
			else $field = new fieldText($key, $p);
		}
	//	champ bool et select
		else
		{
			$tmp = array();
			foreach ($values as $value)
			{
				$tmp[$value] = $value;
			}
			$values = $tmp;
		//	bool
			if (count($values) == 2 && in_array('true', $values) && in_array('false', $values))
			{
				$p = array(
					'label' => $key,
					'labelbefore' => true
				);
				if (isset($matches[1]) && $matches[1] == 'true') $p['value'] = $matches[1];
				$field = new fieldBool($key, $p);
			}
		//	select
			else
			{
				$p = array(
					'label' => $key,
					'values' => $values,
					'valuestype' => 'array',
					'placeholder' => '...'
				);
				if (isset($matches[1])) $p['value'] = $matches[1];
				$field = new fieldSelect($key, $p);
			}
		}
		
		if (isset($valueParam[$key]))
		{
			$field->set_value($valueParam[$key]);
		}
		
		$fields[$key] = $field;
	}
?>