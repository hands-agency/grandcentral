<?php foreach($bunch as $item) : ?>
<?php
//	format Current Separator
	$currentSeparator = formatSeparator($item[$order]);
//	Change separators
	if (!isset($lastSeparator)) echo '<h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
	else if ($lastSeparator != $currentSeparator) echo '</ol><h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
//	Save & format last Separator	
	$lastSeparator = formatSeparator($item[$order]);
?>	
<li class="col-xs-12 col-sm-4 col-md-3 col-lg-2" data-item="<?=$item->get_nickname()?>" data-url="<?=$item['url']?>" data-live="<?=$item['live']?>">
	<div class="card">

		<div class="face front">
			<?php
				if ($coverField)
				{
					$images = $item[$coverField]->unfold();
					$thumbnail = (!$item[$coverField]->is_empty() && $images[0]->exists()) ? $images[0]->thumbnail(300, null)->get_url() : null;
				}
				else $thumbnail = null;
				$empty = (!isset($thumbnail)) ? 'empty' : null;
			?>
			<a href="<?=$item->edit()?>">
				<span class="cover <?=$empty?>" style="background-image:url('<?=$thumbnail?>')"></span>
				<span class="title"><?= (isset($item['title']) && !$item['title']->is_empty()) ? $item['title']->cut(85) : $item->get_table().'#'.$item['id'] ?></span>
			</a>
			<div class="option" data-feathericon=""></div>
	   	</div>

	    <div class="face back">
			<img src="<?=$thumbnail?>" />
			<div class="action">
				<a class="edit" data-feathericon="&#xe095" href="<?=$item->edit()?>">Edit</a>
				<?php if (isset($item['url'])): ?><a class="preview" data-feathericon="&#xe000">Preview</a><?php endif ?>
				<a class="asleep" data-feathericon="&#xe061">Asleep</a>
				<a class="live" data-feathericon="&#xe064">Go live</a>
				<a class="alter" data-feathericon="&#xe064">Alter <?=$item->get_table()?></a>
			</div>
			<div class="preview"><iframe></iframe></div>
	    </div>
	
		<div class="notes"></div>
			
	</div>
</li>
<?php endforeach ?>