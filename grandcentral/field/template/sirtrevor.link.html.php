<h1>External Link</h1>
<div class="external">
	<!-- Stored in an iframe to keep the focus on the highlighted link...-->
	<iframe id="externalLink" src="<?=$iframeLink?>"></iframe>
	<button class="done" data-feathericon="&#xe094">Add link</button>
</div>
<h1>Internal Link</h1>
<div class="internal">
	<?php foreach ($items as $structure): ?>
		<h2><span class="centered"><?=$structure['title']?></span></h2>
		<input type="search" data-item="<?=$structure['key']?>" placeholder="Refine <?=$structure['title']?>" />
		<ul><!-- Welcome Ajax --></ul>
	<?php endforeach ?>
</div>