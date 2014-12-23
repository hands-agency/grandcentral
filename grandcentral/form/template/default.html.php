<form <?= $_FORM->get_attrs(); ?> class="left">
	<?php foreach($_FORM->get_hiddens() as $hidden) : ?>
		<?= $_FORM->get_field($hidden); ?>
	<?php endforeach; ?>
	<?php foreach($_FORM->get_fieldsets() as $fieldset) : ?>
		<fieldset>
		<?php if (isset($fieldset['title'])): ?><legend><?= $fieldset['title']; ?></legend><?php endif; ?>
		<ol>
		<?php foreach($fieldset['fields'] as $field) : ?>
			<? $f = $_FORM->get_field($field); ?>
			<? if ($f->get_key()) $key = 'data-key="'.$f->get_key().'"' ; else $key = '';?>
			
			<?php if (in_array($f->get_key(), $asideFields)): ?>
			<? $asides[] = '<li data-type="'.$f->get_type().'" '.$key.'>'.$f.'</li>'; ?>
			<?php else: ?>
			<li data-type="<?= $f->get_type(); ?>" <?= $key ?>><?= $f; ?></li>
			<?php endif ?>
		<?php endforeach; ?>
		</ol>
		</fieldset>
	<?php endforeach; ?>
</form>
<form <?= $_FORM->get_attrs(); ?> class="right">
	<fieldset>
	<ol>
	<?php foreach ($asides as $aside): ?>
		<?=$aside?>
	<?php endforeach ?>
	</ol>
	</fieldset>
</form>