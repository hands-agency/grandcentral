<div class="nodata" <?= $hideNodata ?>>
	Add a bunch of items to choose from.
</div>
<ol class="data">
	<?= $data; ?>
</ol>
<ul class="add">
	<?= $addbuttons; ?>
</ul>

<pre class="template">
	<? foreach ($template as $key => $html): ?>
	<div class="<?=$key?>"><?=$html?></div>
	<? endforeach ?>
</pre>