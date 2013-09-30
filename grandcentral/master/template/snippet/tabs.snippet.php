<ul class="tabs" data-target="content" <? if (isset($defaultSection)): ?>data-default="<?=$defaultSection?>"<? endif ?>>
	<? foreach($sections as $section) : ?>
	<? $app = $section['app']; ?>
		<li title="<?=$section['descr']?>" data-status="<?=$section['key']?>">
			<a href="<?='#'.$section['key']?>" data-section="<?=$section['key']?>" data-app="<?=$app['key']?>" data-template="<?=$app['template']?>">
				<span class="title"><?=$section['title']?></span>
				<span class="descr"><?=$section['descr']?></span>
			</a>
			<? if (isset($section['count'])) : ?><span class="cc-bubble"><?=$section['count']?></span><? endif; ?>
			<div class="droppable"></div>
		</li>
	<? endforeach; ?>
</ul>