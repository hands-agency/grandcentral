<?php
	// print'<pre>';print_r($_POST);print'</pre>';
	// chemin du fichier de paramètres
	$file = app($_POST['valueApp'], null, null, $_POST['env'])->get_templateroot().$_POST['valueTemplate'].'.param.php';
	// echo $file;
	if (is_file($file)) :
	
	$fields = array();
	// PORC on inclue le fichier de paramètres
	include($file);
	
//	on remplir les valeurs de chaque champ		
	// $valueParam = array();
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
	if (isset($valueParam))
	{
		foreach ($valueParam as $key => $param)
		{
			if (isset($fields[$key]))
			{
				$fields[$key]->set_value($param);
			}
		}
	}
?>
<?php foreach ($fields as $field) : ?>
	<li data-type="<?= $field->get_type(); ?>" data-key="<?= $field->get_key(); ?>" data-specialdataname="param"><?= $field; ?></li>
<?php endforeach; ?>
<?php endif; ?>