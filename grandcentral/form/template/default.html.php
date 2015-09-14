<?php
//	Main form
	foreach($_FORM->get_fieldsets() as $fieldset)
	{
	//	Loop fields
		$mainFields = '';
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
	//	Encapsulate in fieldset
		$col = (empty($asides)) ? null : 'col-xs-12 col-sm-8 col-md-9 col-lg-9';
		$mainFieldsets .= '<fieldset class="'.$col.'">';
		if (isset($fieldset['title'])) $mainFieldsets .= '<legend>'.$fieldset['title'].'</legend>';
		$mainFieldsets .= '<ol>'.$mainFields.'</ol>';
		$mainFieldsets .= '</fieldset>';
	}
?>
<form <?= $_FORM->get_attrs(); ?>>
	
	<?php foreach($_FORM->get_hiddens() as $hidden) : ?>
		<?= $_FORM->get_field($hidden); ?>
	<?php endforeach; ?>
	<?=$mainFieldsets?>
	
	<?php if (!empty($asides)): ?>
		<fieldset class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
		<ol>
		<?php foreach ($asides as $aside): ?>
			<?=$aside?>
		<?php endforeach ?>
		</ol>
		</fieldset>
	<?php endif ?>
	
</form>