<form <?= $_ITEM->get_attrs(); ?>>
	<? foreach($_FORM->get_hiddens() as $hidden) : ?>
		<?= $_FORM->get_field($hidden); ?>
	<? endforeach; ?>
	<? foreach($_FORM->get_fieldsets() as $fieldset) : ?>
		<fieldset>
		<? if (isset($fieldset['title'])): ?><legend><?= $fieldset['title']; ?></legend><? endif; ?>
		<? if (isset($fieldset['descr'])): ?><div class="descr"><?=$fieldset['descr']?></div><?php endif ?>
		<ol>
		<? foreach($fieldset['fields'] as $field) : ?>
			<? $f = $_FORM->get_field($field); ?>
			<? if ($f->get_key()) $key = 'data-key="'.$f->get_key().'"' ; else $key = '';?>
			<?
				$value = $f->get_value();
				$collapse = (empty($value) && $f->is_required() === false) ? 'class="collapse"' : null;
			?>
			<li data-type="<?= $f->get_type(); ?>" <?= $key ?> <?= $collapse ?>>
				<label for="<?= $f->get_name(); ?>"><?= $f->get_label(); ?></label><? $f->set_label(''); ?><div class="wrapper"><?= $f; ?><div class="help"><? if ($f->get_descr() != null) $f->get_descr(); ?></div></div>
			</li>
		<? endforeach; ?>
		</ol>
		</fieldset>
	<? endforeach; ?>
</form>