<div class="zoningselected">
	
	<div class="browser">
		<? if (!empty($zones)): foreach($zones as $zone): ?>
		<div class="zone selected <? if (isset($zone['float'])) :?><?=$zone['float']?><? endif ?>">
			<div class="title"><?=$zone['key']?></div>
			<ol data-nodata="<?=cst('ZONING_SELECTED_NODATA')?>"><? if (isset($zone['section'])): foreach($zone['section'] as $section): ?>
				<li class="z_<?=$section['key']?>">
					<span class="handle" data-feathericon="&#xe026"></span>
					<button class="delete" type="button"></button>
					<div class="icon"></div>
					<div class="title"><span class="flag"><?=$section['app']['app']?></span><?=$section['title']?></div>
					<input type="hidden" name="<?=$fieldName?>[]" value="<?=$section->get_nickname()?>" />
				</li>
				<? endforeach; endif; ?></ol>
		</div>
		<? endforeach; else: ?>
		<div class="nodata">This master template has no zone</div>
		<? endif; ?>
	</div>
</div>

<div class="zoningavailable">
	<ul class="tabs">
		<li class="on"><a>Apps</a></li>
		<li><a>Section</a></li>
	</ul>
	<div class="available">
		<!--button>New</button-->
		<ul class="choices"><!-- Welcome Ajax --></ul>
	</div>
</div>
<div class="clear"><!-- Clearing floats --></div>
<?=$name?>
<?=$values?>
<?=$valuestype?>