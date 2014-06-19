<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<? if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><? endif ?>
	<div class="field" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $_SESSION['pref']['handled_env']; ?>">
	
		<?= $field; ?>
		<button type="button">Configure ⇢</button>
		
		<span class="configure">
			<span class="template">
		<?php if ($template): ?>
			<input type="hidden" name="<?= $_FIELD->get_name(); ?>[template]" value="<?=$template?>" />
		<?php endif ?>
			</span>
			<span class="param">
		<?php if ($param): ?>
		<?php foreach ($value['param'] as $key => $value): ?>
				<?php if (!is_array($value)): ?>
				<textarea name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>]" style="display:block"><?=$value?></textarea>
				<?php else: ?>
				<?php foreach ($value as $k => $v): ?>
				<textarea name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>][<?=$k?>]" style="display:block"><?=$v?></textarea>
				<?php endforeach ?>
				<?php endif ?>
		<?php endforeach ?>
		<?php endif ?>
			</span>
		</span>
	
	</div>
</div>