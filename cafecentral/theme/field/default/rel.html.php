<input type="hidden" name="<?=$_ITEM->get_name() ?>" value="" />
<div class="nodata" <?= $hideNodata ?>>
	Add a relation to link this item to other items, for instance, link a t-shirt to one or several sizes.
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