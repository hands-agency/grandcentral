<ul class="tabs" data-target="content" <? if (isset($defaultSection)): ?>data-default="<?=$defaultSection?>"<? endif ?>>
	<? foreach($sections as $section) : ?>
	<? $template = $section['template']; ?>
		<li title="<?=$section['descr']?>" data-status="<?=$section['key']?>">
			<a href="<?='#'.$section['key']?>" data-section="<?=$section['key']?>" data-theme="<?=$template['theme']?>" data-template="<?=$template['template']?>">
				<span class="title"><?=$section['title']?></span>
				<span class="descr"><?=$section['descr']?></span>
			</a>
			<? if (isset($section['count'])) : ?><span class="cc-bubble"><?=$section['count']?></span><? endif; ?>
			<div class="droppable"></div>
		</li>
	<? endforeach; ?>
</ul>