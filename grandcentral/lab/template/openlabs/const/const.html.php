<?php if (!isset($versions)): ?>
<div class="nodata">There are no const to translate.</div>
<?php else: ?>
<h1>Translate constants</h1>
<table>
	<tr>
		<th>key</th>
		<?php foreach ($versions as $version): ?>
		<th><?=$version['title']?></th>
		<?php endforeach ?>
	</tr>
	<?php foreach ($consts as $const): ?>
	<tr>
		<td><?=$const['key']?></td>
		<?php foreach ($versions as $version): ?>
		<td><input type="text" name="" value="<?=$const['title'][$version['key']->get()]?>"></td>
		<?php endforeach ?>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>
