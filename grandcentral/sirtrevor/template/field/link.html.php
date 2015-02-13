<ul class="tabs">
	<li data-tab="internal" class="on" unselectable="on">Internal</li>
	<li data-tab="external" class="off">External</li>
	<li data-tab="media" class="of">Media</li>
</ul>

<ul class="panels">
	
	<div class="on" data-panel="internal">
		<?php foreach ($items as $structure): ?>
			<h2><span class="rule"><?=$structure['title']?></span></h2>
			<input type="search" data-item="<?=$structure['key']?>" placeholder="Refine <?=$structure['title']?>" />
			<ul><!-- Welcome Ajax --></ul>
		<?php endforeach ?>
	</div>
	
	<div class="off" data-panel="external">
		<!-- Stored in an iframe to keep the focus on the highlighted link...-->
		<iframe src="<?=$iframeLink?>"></iframe>
		<button class="done" data-feathericon="&#xe094">Add link</button>
	</div>
	
	<div class="off" data-panel="media"></div>
</div>