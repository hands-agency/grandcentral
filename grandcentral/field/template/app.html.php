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
			<span class="fieldTemplateContainer" data-appkey="<?= $value['key']; ?>" data-template="<?= $template; ?>" data-param="<?= $params; ?>">
				<!-- Ajax -->
			</span>
		</div>
	
	</div>
</div>