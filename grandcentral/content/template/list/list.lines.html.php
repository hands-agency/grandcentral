<?php foreach($bunch as $i) : ?>
<?php
//	format Current Separator
	$currentSeparator = formatSeparator($i[$order]);
//	Change separators
	if (!isset($lastSeparator)) echo '<h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
	else if ($lastSeparator != $currentSeparator) echo '</ol><h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
//	Save & format last Separator	
	$lastSeparator = formatSeparator($i[$order]);
?>	
<li class="col-xs-12 col-sm-4 col-md-3 col-lg-2" data-item="<?=$i->get_nickname()?>" data-url="<?=$i['url']?>" data-status="<?=$i['status']?>">
	<div class="card">

		<div class="face front">
			<?php
				if ($coverField)
				{
					$images = $i[$coverField]->unfold();
					$thumbnail = (!$i[$coverField]->is_empty() && $images[0]->exists()) ? $images[0]->thumbnail(300, null)->get_url() : null;
				}
				else $thumbnail = null;
				$empty = (!isset($thumbnail)) ? 'empty' : null;
			?>
			<a href="<?=$i->edit()?>" class="<?=$empty?>">
				<img src="<?=$thumbnail?>" />
				<span class="cover" style="background-image:url('<?=$thumbnail?>')"></span>
				<span class="title"><?= (isset($i['title']) && !$i['title']->is_empty()) ? $i['title']->cut(50) : $i->get_table().'#'.$i['id'] ?></span>
			</a>
			<div class="option" data-feathericon=""></div>
	   	</div>

	    <div class="face back">
			
			<div class="action">
				<a class="edit" data-feathericon="&#xe095" href="<?=$i->edit()?>">Edit</a>
				<?php if (isset($i['url'])): ?><a class="preview" data-feathericon="&#xe000">Preview</a><?php endif ?>
				<a class="asleep" data-feathericon="&#xe061">Asleep</a>
				<a class="live" data-feathericon="&#xe064">Go live</a>
				<a class="alter" href="<?=$item->edit()?>" data-feathericon="&#xe064">Alter <?=$item['title']?></a>
			</div>
			<div class="preview"><iframe></iframe></div>
	    </div>
	
		<div class="notes"></div>
			
	</div>
</li>
<?php endforeach ?>