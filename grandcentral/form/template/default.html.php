<?
//	Main form
	foreach($_FORM->get_fieldsets() as $fieldset)
	{
		$mainFields .= '<fieldset>';
		if (isset($fieldset['title'])) $mainFields .= '<legend>'.$fieldset['title'].'</legend>';
		$mainFields .= '<ol>';
		foreach($fieldset['fields'] as $field)
		{
			$f = $_FORM->get_field($field);
			if ($f->get_key()) $key = 'data-key="'.$f->get_key().'"';
			else $key = '';
			
		//	This field goes into the aside form...
			if (in_array($f->get_key(), $asideFields)) $asides[] = '<li data-type="'.$f->get_type().'" '.$key.'>'.$f.'</li>';
		//	...or stays in the main form
			else $mainFields .= '<li data-type="'.$f->get_type().'" '.$key.'>'.$f.'</li>';
		}
		$mainFields .= '</ol>';
		$mainFields .= '</fieldset>';
	}
?>
<form <?= $_FORM->get_attrs(); ?> <?php if (!empty($asides)): ?>class="col-xs-12 col-sm-8 col-md-9 col-lg-9"<?php endif ?>>
	<?php foreach($_FORM->get_hiddens() as $hidden) : ?>
		<?= $_FORM->get_field($hidden); ?>
	<?php endforeach; ?>
	<?=$mainFields?>
</form>
<?php if (!empty($asides)): ?>
<form <?= $_FORM->get_attrs(); ?> class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
	<fieldset>
	<ol>
	<?php foreach ($asides as $aside): ?>
		<?=$aside?>
	<?php endforeach ?>
	</ol>
	</fieldset>
</form>
<?php endif ?>