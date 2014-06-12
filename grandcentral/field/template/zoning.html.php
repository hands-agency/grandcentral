<div class="zoningselected">
	
	<div class="browser">
		<? if (isset($zones)): foreach($zones as $zone): ?>
		<div class="zone selected <? if (isset($zone['float'])) :?><?=$zone['float']?><? endif ?>">
			<div class="title"><?=$zone['key']?></div>
			<ol data-nodata="<?=cst('ZONING_SELECTED_NODATA')?>"><? if (isset($zone['section'])): foreach($zone['section'] as $section): ?>
				<li class="z_<?=$section['key']?>">
					<span class="handle" data-feathericon="&#xe026"></span>
					<button class="delete" type="button"></button>
					<div class="icon"></div>
					<div class="title"><?=$section['title']?></div>
					<input type="hidden" name="<?=$fieldName?>[]" value="<?=$section->get_nickname()?>" />
				</li>
				<? endforeach; endif; ?></ol>
		</div>
		<? endforeach; else: ?>
		<div class="nodata"><?=cst('ZONING_NODATA')?></div>
		<? endif; ?>
	</div>
</div>

<div class="zoningavailable">
	<ul class="tabs">
		<li class="on"><a>Apps</a></li>
		<li><a>Section</a></li>
	</ul>
	<div class="available">
		<ul class="fav">
			<? foreach($favs as $fav): ?>
			<li class="<?=$fav['key']?>">
				<span class="handle" data-feathericon="&#xe026"></span>
				<button class="delete" type="button"></button>
				<div class="icon"></div>
				<div class="title"><?=$fav['title']?></div>
				<input type="hidden" name="[]" value="<?=$fav->get_nickname()?>" />
			</li>
			<? endforeach; ?>
		</ul>
		<ul class="choices"><!-- Welcome Ajax --></ul>
	</div>
</div>
<div class="clear"><!-- Clearing floats --></div>
<?=$name?>
<?=$values?>
<?=$valuestype?>