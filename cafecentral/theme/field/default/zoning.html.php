<div class="droppable">
	<div class="browser">
		<span class="cc-bubble warning"><?=ZONING_SELECTED_BUBBLE?></span>
		<? if (isset($zones)): foreach($zones as $zone): ?>
		<div class="zone selected <? if (isset($zone['float'])) :?><?=$zone['float']?><? endif ?>">
			<div class="title"><?=$zone['key']?></div>
			<ol>
				<li class="nodata" <?=$zone['hideNodata']?>><?=ZONING_SELECTED_NODATA?></li>
				<? if (isset($zone['section'])): foreach($zone['section'] as $section): ?>
				<li data-item="<?=$section->get_nickname()?>">
					<button class="delete" type="button"></button>
					<div class="icon"></div>
					<div class="title"><?=$section['title']?></div>
					<input type="hidden" name="<?=$_ITEM->get_name()?>[]" value="<?=$section->get_nickname()?>" />
				</li>
				<? endforeach; endif; ?>
			</ol>
		</div>
		<? endforeach; else: ?>
		<div class="nodata"><?=ZONING_NODATA?></div>
		<? endif; ?>
	</div>
	<div class="legend">
		⇡ <?=ZONING_LEGEND?>
	</div>
</div>
<div class="draggable">
	<ul class="tabs">
		<li class="on"><a data-available="app"><?=ZONING_AVAILABLE_LABEL?></a></li>
		<li><a data-available="section">Section</a></li>
	</ul>
	<div class="available" data-name="<?=$name?>" data-values="<?=$values?>" data-valuestype="<?=$valuestype?>">
		<ul class="fav">
			<? foreach($favs as $fav): ?>
			<li class="<?=$fav['key']?>" data-item="<?=$fav->get_nickname()?>">
				<button class="delete" type="button"></button>
				<div class="icon"></div>
				<div class="title"><?=$fav['title']?></div>
			</li>
			<? endforeach; ?>
		</ul>
		<ul class="choices"><!-- Welcome Ajax --></ul>
	</div>
</div>
<div class="clear"><!-- Clearing floats --></div>