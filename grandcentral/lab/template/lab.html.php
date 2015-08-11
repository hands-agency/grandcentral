<?php if (!isset($labs)): ?>
<div class="nodata">There are no open labs.</div>
<?php else: ?>
<h1>Open labs</h1>
<ul id="labToc">
	<?php foreach ($labs as $dir => $content): ?>
	<li><a href="openlabs/<?=$dir?>/<?=$dir?>"><?=$dir?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>