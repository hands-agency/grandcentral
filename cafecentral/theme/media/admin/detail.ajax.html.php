<div class="detail">
	<? if (isset($thumbnail)): ?>
	<div class="media">
		<img src="<?= $thumbnail ?>" data-file="<?= $key; ?>" data-path="<?= $path; ?>" />
	</div>
	<? endif ?>
	<table class="about">
		<tr>
			<td>File</td>
			<td><?= $key; ?></td>
		</tr>
		<tr>
			<td>Root</td>
			<td><?= $root; ?></td>
		</tr>
		<tr>
			<td>Url</td>
			<td><?= $url; ?></td>
		</tr>
		<tr>
			<td>Type</td>
			<td><?= $type; ?></td>
		</tr>
		<? if (isset($dimensions)) : ?>
		<tr>
			<td>Dimensions</td>
			<td><?= $dimensions['width'] ?> x <?= $dimensions['height'] ?></td>
		</tr>
		<? endif ?>
		<tr>
			<td>Size</td>
			<td><?= $size; ?></td>
		</tr>
		<tr>
			<td>Created</td>
			<td><?= $created; ?></td>
		</tr>
		<tr>
			<td>Updated</td>
			<td><?= $updated; ?></td>
		</tr>
	</table>
	<button type="button" class="back">⇠ Back</button>
</div>