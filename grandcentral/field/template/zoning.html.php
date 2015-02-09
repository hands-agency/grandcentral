<div class="zoningselected">
	
	<ul class="devices">
		<li>Mobile</li>
		<li>Laptop</li>
		<li>Tablet</li>
		<li>Wide screen</li>
	</ul>
	
	<div class="field" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $handled_env; ?>">
		
		<?php if (!empty($zones)): ?>
		<?php foreach ($zones as $inout => $zones): ?>	
		<div class="zones <?=$inout?>">
			
			<?php if ($inout == 'in'): ?>		
			<div class="browserbar">
				<div class="buttons">●●●</div>
				<div class="addressbar"><?=$page['url']?></div>
			</div>
			<?php endif ?>

			<?php foreach ($zones as $zone): ?>
			<div data-zone="<?=$zone['key']?>" class="zone selected <?php if (isset($zone['float'])) :?><?=$zone['float']?><?php endif ?>" <?php if (isset($zone['width'])) :?>style="width:<?=$zone['width']?>%;"<?php endif ?>>
				<div class="title"><?=$zone['key']?></div>
				<ol data-nodata="<?=cst('ZONING_SELECTED_NODATA')?>"><?php if (isset($zone['section'])): foreach($zone['section'] as $section): ?>
					<?php
					//	App
						$app = $section['app']['app'];
					//	template
						$template = (isset($section['app']['template']) & !empty($section['app']['template'])) ? $section['app']['template'] : null;
					//	param
						$param = (isset($section['app']['param']) & !empty($section['app']['param'])) ? htmlspecialchars(json_encode($section['app']['param']), ENT_COMPAT, 'UTF-8') : null;
					?>
					<li>
						
						<span class="handle" data-feathericon="&#xe026"></span>
						<button class="delete" type="button"></button>
						
						<div class="title"><span><span class="flag"><?=$app?></span><?=$section['title']?></span></div>
						
						<div class="preview"><iframe src="<?=$iframe['url']->args(array('section' => $section->get_nickname(), 'page' => $page->get_nickname()))?>"></iframe></div>
		
						<input type="hidden" name="<?=$fieldName?>[]" value="<?=$section->get_nickname()?>" />
					
					</li>
				<?php endforeach ?>
				<?php endif; ?></ol>
			</div>
			<?php endforeach ?>
		<div class="clear"><!-- Clearing floats --></div></div>
		<?php endforeach; else: ?>
		<div class="nodata">This master template has no zone</div>
		<?php endif; ?>
	</div>
</div>

<div class="zoningavailable">
	<div class="available" data-name="<?=$fieldName?>">
		<ul class="choices"><!-- Welcome Ajax --></ul>
	</div>
</div>
<div class="clear"><!-- Clearing floats --></div>
<?=$name?>
<?=$values?>
<?=$valuestype?>