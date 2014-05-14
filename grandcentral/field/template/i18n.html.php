<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>

<?php foreach ($fields as $field): ?>
	<?php echo $field; ?>
<?php endforeach ?>