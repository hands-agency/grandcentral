<h1>Configure</h1>
<?php if ($templates): ?>
<div class="template">
	<h2>Templates</h2>
	<?= $fieldTemplate; ?>
</div>
<?php endif ?>

<?php if (isset($fields) && !empty($fields)): ?>
<div class="param">
	<h2>Params</h2>
	<form>
		<fieldset>
			<ol>
			<?php foreach ($fields as $field) : ?>
				<li data-type="<?= $field->get_type(); ?>" data-key="<?= $field->get_key(); ?>"><?= $field; ?></li>
			<?php endforeach; ?>
			</ol>
		</fieldset>
	</form>
</div>
<?php endif ?>

<button class="done" data-feathericon="&#xe094"> Done</button>