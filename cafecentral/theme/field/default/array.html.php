<div class="nodata" <?= $hideNodata ?>>
	Add an array of parameters to refine your bunch of items.
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