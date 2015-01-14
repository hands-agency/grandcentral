<div class="zoningselected">
	
	<div class="field" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $handled_env; ?>">
		
		<?php if (!empty($zones)): ?>
		<?php foreach ($zones as $inout => $zones): ?>	
			<div class="zones <?=$inout?>">
				

		<?php foreach ($zones as $zone): ?>
				
		<div class="zone selected <?php if (isset($zone['float'])) :?><?=$zone['float']?><?php endif ?>">
			<div class="title"><?=$zone['key']?></div>
			<ol data-nodata="<?=cst('ZONING_SELECTED_NODATA')?>"><?php if (isset($zone['section'])): foreach($zone['section'] as $section): ?>
				<li data-section="<?=$section['key']?>" data-app="<?=$section['app']['app']?>">
					<span class="handle" data-feathericon="&#xe026"></span>
					<button class="delete" type="button"></button>
					<div class="icon"></div>
					<div class="title"><span class="flag"><?=$section['app']['app']?></span><?=$section['title']?></div>
					<input type="hidden" name="<?=$fieldName?>[]" value="<?=$section->get_nickname()?>" />
					
					<span class="configure">
						<?php
						//	template
							$template = (isset($section['app']['template']) & !empty($section['app']['template'])) ? $section['app']['template'] : null;
						//	param
							$param = (isset($section['app']['param']) & !empty($section['app']['param'])) ? htmlspecialchars(json_encode($section['app']['param']), ENT_COMPAT, 'UTF-8') : null;
						?>
						<span class="template">
						<?php if ($template): ?>
						<input type="hidden" name="<?= $_FIELD->get_name(); ?>[template]" value="<?=$template?>" />
						<?php endif ?>
						</span>
						<span class="param">
						<?php if ($param): ?>
						<?php foreach ($section['app']['param'] as $key => $value): ?>
							<?php if (!is_array($value)): ?>
							<textarea style="display:none" name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>]"><?=$value?></textarea>
							<?php else: ?>
							<?php foreach ($value as $k => $v): ?>
							<textarea style="display:none" name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>][<?=$k?>]"><?=$v?></textarea>
							<?php endforeach ?>
							<?php endif ?>
						<?php endforeach ?>
						<?php endif ?>
						</span>
					</span>
					
				</li>
			<?php endforeach ?>
			<?php endif; ?></ol>
		</div>
			<?php endforeach ?>
			</div>
		<?php endforeach; else: ?>
		<div class="nodata">This master template has no zone</div>
		<?php endif; ?>
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