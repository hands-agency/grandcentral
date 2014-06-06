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
	if ($_POST['valueParam'])
	{
		foreach ($_POST['valueParam'] as $param)
		{
			$pattern = '/\[([a-zA-Z0-9_\-]*)\]$/';
			preg_match($pattern, $param['name'], $matches);
			$fields[$matches[1]]->set_value($param['value']);
		}
	}
?>
<?php foreach ($fields as $field) : ?>
	<li class="<?= $field->get_type(); ?>" data-type="param">
		<label for="<?= $field->get_name(); ?>"><?= $field->get_label(); ?><span class="help"></span></label>
		<? $field->set_label(''); ?>
		<div class="wrapper">
			<? if ($field->get_descr() != null) : ?><div class="help"><?= $field->get_descr(); ?></div><?php endif ?>
			<?= $field; ?>
		</div>
	</li>
<?php endforeach; ?>
<?php endif; ?>