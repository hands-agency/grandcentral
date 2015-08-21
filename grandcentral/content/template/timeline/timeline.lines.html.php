<?php foreach($clusters as $cluster) : ?>
	<?php if (isset($cluster['bunch'])): ?>

<?php
//	Get the current bunch, author
	$bunch = $cluster['bunch'];
	$date = $cluster['date'];
	$author = $authors[$cluster['subject'].'_'.$cluster['subjectid']];
	
//	Format Current Separator
	$currentSeparator = formatSeparator($date, $period);
//	Change separators
	if (!isset($lastSeparator)) echo '<h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
	else if ($lastSeparator != $currentSeparator) echo '</ol><h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
//	Save & format last Separator	
	$lastSeparator = formatSeparator($date, $period);
?>	
<li>
	<?php
		$authorIcon = (isset($author['profilepic']) && !$author['profilepic']->is_empty()) ? $author['profilepic']->unfold()[0]->get_url(true) : null;
	?>
	<div class="icon"><a href="<?=$author->edit()?>" style="background-image:url(<?=$authorIcon?>);"></a></div>
	
	<div class="padding">
		
		<div class="title">
			<a href="<?=$author->edit()?>" class="item"><?=$cluster['item']?></a>
			<?php
				$authorName = ($author == $_SESSION['user']) ? 'You' : $author['firstname'].' '.$author['lastname'];
			?>
			<a href="<?=$author->edit()?>" class="author"><?=$authorName?></a> <?=cst('eventstream_'.$cluster['key'])?>
			
			<?php $iTitle = 0; ?>
			<?php foreach ($bunch as $item): ?>
			<?php
				$title = ($item['title']) ? $item['title']->cut(50) : $item->get_table().' #'.$item['id'];
				echo '<a href="'.$item->edit().'">'.$title.'</a>,';
			//	Ok, we have one
				$iTitle ++;
			//	Stop here
				if ($iTitle == $maxTitle)
				{
				//	Remaining elements
					$remain = $bunch->count - $maxTitle;
					if ($remain > 0) echo ' and '.$remain.' others.';
					break;
				}
			?>			
			<?php endforeach ?>
		</div>
				
		<?php if ($bunch->count > 0 && isset($iconField[$bunch[0]->get_table()])): ?>
			
			<?php $iThumbnail = 0; $li = null; ?>
			<?php foreach ($bunch as $item): ?>
			<?php
				$field = $iconField[$item->get_table()];
				if (!$item[$field]->is_empty())
				{
					$image = $item[$field]->unfold()[0];
					if ($image->exists())
					{
						$imageUrl = $image->thumbnail(500,500)->get_url(true);
					//	$imageUrl = $image->get_url(true);
						$li .= '<li><a href="'.$item->edit().'" style="background-image:url('.$imageUrl.');"></a></li>';
					//	Ok, we have one
						$iThumbnail ++;
					}
				}
				else $imageUrl = null;

				if ($iThumbnail == $maxThumbnail) break;
			?>
			<?php endforeach ?>
		<?php
		//	We have some thumbnails
			if ($li) echo '<ul class="thumbnails">'.$li.'</ul>';
		?>
		<?php endif ?>
		
	</div>
</li>
	<?php endif ?>
<?php endforeach ?>