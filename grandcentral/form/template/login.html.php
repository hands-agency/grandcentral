<div id="overlay">
	<form <?= $_FORM->get_attrs(); ?>>
		<div id="profilepic">
			<div class="front" style="background-image:url(<?=$profilepic?>)"></div>
			<div class="back"></div>
		</div>
		<?php foreach($_FORM->get_hiddens() as $hidden) : ?>
			<?= $_FORM->get_field($hidden); ?>
		<?php endforeach; ?>
		<?php foreach($_FORM->get_fieldsets() as $fieldset) : ?>
			<fieldset>
			<?php if (isset($fieldset['title'])): ?><legend><?= $fieldset['title']; ?></legend><?php endif; ?>
			<ol>
			<?php foreach($fieldset['fields'] as $field) : ?>
				<?php $f = $_FORM->get_field($field); ?>
				<?php if ($f->get_key()) $key = 'data-key="'.$f->get_key().'"' ; else $key = '';?>
				<li data-type="<?= $f->get_type(); ?>" <?= $key ?>><?= $f; ?></li>
			<?php endforeach; ?>
			</ol>		
			</fieldset>
		<?php endforeach; ?>
	</form>
</div>