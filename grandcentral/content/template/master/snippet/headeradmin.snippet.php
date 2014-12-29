<ul id="options">
	<li id="refine" class="off" data-feathericon="&#xe036"><input type="search" placeholder="Refine or ↵ search" /></li>
	<li id="filter" class="off" data-feathericon="&#xe023"></li>
</ul>
<ul id="tabs" data-target="content" <? if (isset($defaultSection)): ?>data-default="<?=$defaultSection?>"<? endif ?>>
	<? foreach($sections as $section) : ?>
	<? $app = $section['app']; ?>
	<?
	//	Try to find the right title for the tab
		$const = strtoupper('TABS_'.$handled_item.'_'.$section['key']);
		$title = (defined($const.'_TITLE')) ? constant($const.'_TITLE') : $section['title'];
		$descr = (defined($const.'_DESCR')) ? constant($const.'_DESCR') : $section['descr'];
	?>
		<li title="<?=$section['descr']?>" data-status="<?=$section['key']?>">
			<a href="<?='#'.$section['key']?>" data-section="<?=$section['key']?>" data-app="<?=$app['app']?>" data-template="<?=$app['template']?>" data-param='<?=json_encode($app['param'])?>'>
				<span class="title"><?=$title?></span>
				<span class="descr"><?=$descr?></span>
			</a>
			<? if (isset($section['count'])) : ?><span class="cc-bubble"><?=$section['count']?></span><? endif; ?>
			<div class="droppable"></div>
		</li>
	<? endforeach; ?>
</ul>
<div class="drawer closed"><!-- Welcome Ajax --></div>