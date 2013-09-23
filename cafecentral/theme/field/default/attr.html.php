<div class="nodata" <?= $hideNodata ?>>
	Add an attribute to store more data about an item. For instance, store a description or a quantity.
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