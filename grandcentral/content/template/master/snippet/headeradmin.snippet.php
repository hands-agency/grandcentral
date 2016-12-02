<ul class="options">
	<li id="refine" class="off" data-feathericon="&#xe036"><input type="search" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Refine or ↵ search" /></li>
	<li id="filter" class="off" data-feathericon="&#xe023"></li>
</ul>
<ul id="tabs" data-target="content" <?php if (isset($defaultSection)): ?>data-default="<?=$defaultSection?>"<?php endif ?>>
	<?php foreach($sections as $section) : ?>
	<?php $app = $section['app']; ?>
	<?php
	//	Try to find the right title for the tab
		$const = strtoupper('TABS_'.$handled_item.'_'.$section['key']);
		$title = (defined($const.'_TITLE')) ? constant($const.'_TITLE') : $section['title'];
		$descr = (defined($const.'_DESCR')) ? constant($const.'_DESCR') : $section['descr'];
	?>
		<li title="<?=$section['descr']?>" data-index="<?=$i?>">
			<a href="<?='#'.$section['key']?>" data-section="<?=$section['key']?>" data-app="<?=$app['app']?>" data-template="<?=$app['template']?>" data-param='<?=json_encode($app['param'])?>'>
				<span class="title"><?=$title?></span>
				<span class="descr"><?=$descr?></span>
			</a>
			<?php if (isset($section['count'])) : ?><span class="cc-bubble"><?=$section['count']?></span><?php endif; ?>
			<div class="droppable"></div>
		</li>
	<?php $i++ ?>
	<?php endforeach; ?>
</ul>
<div class="drawer closed"><!-- Welcome Ajax --></div>