<!-- We need to reroute the page id here def-->
<input type="hidden" name="<?=$formName?>[id]" value="<?=$page['id']?>" />

<div class="zoningselected">
	
	<h1><span class="site"><?=i('site', current)['title']?></span> <span class="divider">•</span> <span class="page"><?=$page['title']?></span></h1>
	
	
	<ul class="devices">
		<li data-device="phone">
			<div class="title">Phones</div>
			<div class="size">< 768px</div>
		</li>
		<li data-device="tablet">
			<div class="title">Tablet</div>
			<div class="size">≥ 768px</div>
		</li>
		<li data-device="laptop" class="default">
			<div class="title">Laptop</div>
			<div class="size">≥ 992px</div>
		</li>
		<li data-device="desktop">
			<div class="title">Desktop</div>
			<div class="size">≥ 1200px</div>
		</li>
	</ul>
	
	<div class="field" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $handled_env; ?>">
		<input type="hidden" name="<?= $fieldName; ?>" value="" />
		<?php if (!empty($zones)): ?>
		<?php foreach ($zones as $inout => $zones): ?>
			
		<div class="zones <?=$inout?>" data-device="phone">
			
			<?php if ($inout == 'in'): ?>		
			<div class="browserbar">
				<div class="buttons"><span>●</span><span>●</span><span>●</span></div>
				<div class="addressbar"><?=$page['url']?></div>
			</div>
			<div class='floatingline'></div>
			<?php endif ?>

			<?php foreach ($zones as $zone): ?>
			<div data-zone="<?=$zone['key']?>" class="zone selected <?php if (isset($zone['float'])) :?><?=$zone['float']?><?php endif ?>" <?php if (isset($zone['width'])) :?>style="width:<?=$zone['width']?>%;"<?php endif ?>>
				<div class="title">
					<span><?=$zone['key']?></span>
				</div>
				<ol data-nodata="<?=cst('ZONING_SELECTED_NODATA')?>"><?php if (isset($zone['section'])): foreach($zone['section'] as $section): ?><?php
					//	App
						$app = $section['app']['app'];
					//	template
						$template = (isset($section['app']['template']) & !empty($section['app']['template'])) ? $section['app']['template'] : null;
					//	param
						$param = (isset($section['app']['param']) & !empty($section['app']['param'])) ? htmlspecialchars(json_encode($section['app']['param']), ENT_COMPAT, 'UTF-8') : null;
					?><li data-item="<?=$section->get_nickname()?>">
						
						<button class="delete" type="button"></button>
						
						<a class="title">
							<span><?=$section['title']?></span>
							<span class="app"><?=$app?></span>
						</a>
						
						<div class="preview"><!--iframe src="<?=$iframe['url']->args(array('section' => $section->get_nickname(), 'page' => $page->get_nickname()))?>"></iframe--></div>
		
						<input type="hidden" name="<?=$fieldName?>[]" value="<?=$section->get_nickname()?>" />
					
					</li><?php endforeach ?><?php endif; ?></ol>
			</div>
			<?php endforeach ?>
		<div class="clear"><!-- Clearing floats --></div></div>
		<?php endforeach; else: ?>
		<div class="nodata">This master template has no zone</div>
		<?php endif; ?>
	</div>
</div>

<div class="zoningavailable">
	<div class="available" data-name="<?=$name?>" data-values="<?=$values?>" data-valuestype="<?=$valuestype?>">
		<div class="add"><button></button></div>
		<ul class="choices"><!-- Welcome Ajax --></ul>
	</div>
</div>
<div class="clear"><!-- Clearing floats --></div>