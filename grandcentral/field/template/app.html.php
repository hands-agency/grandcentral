<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<? if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><? endif ?>
	<div class="field">
	
		<div class="fieldAppContainer" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $_SESSION['pref']['handled_env']; ?>">
			<span class="fieldAppSelect"><?= $field; ?></span>
			<button type="button">Configure</button>
			<span class="fieldTemplateContainer" data-appkey="<?= $value['app']; ?>" data-template="<?= $template; ?>" data-param="<?= $param; ?>">
				<?php if ($template): ?>
					<input type="hidden" name="<?= $_FIELD->get_name(); ?>[template]" value="<?=$value['template']?>" />
				<?php endif ?>
				
				<?php if ($param): ?>
				<?php foreach ($value['param'] as $key => $value): ?>
					<input type="hidden" name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>]" value="<?=$value?>" />
				<?php endforeach ?>
				<?php endif ?>
			</span>
		</div>
	
	</div>
</div>