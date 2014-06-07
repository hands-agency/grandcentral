<input type="hidden" name="<?=$_FIELD->get_name()?>" value="" />
<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><?php endif ?>
	<span class="field">

		<ol class="data">
			<?= $data; ?>
			<li class="upload" data-feathericon="&#xe010"></li>
		</ol>
		<pre class="template">
			<?=$template; ?>
		</pre>
		
	</span>
</div>