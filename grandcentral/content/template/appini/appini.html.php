<header>
	<div class="cover" <?php if (isset($ini['about']['cover'])): ?>style="background-image:url('<?=$ini['about']['cover']?>')"<?php endif ?>>></div>
	<h1><?=$ini['about']['title']?></h1>
	<?php if (isset($ini['about']['descr'])): ?><div class="descr"><?=$ini['about']['descr']?></div><?php endif ?>
</header>

<article>
	
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		
		<?php if (isset($ini['about']['intro'])): ?><div class="intro"><?=$ini['about']['intro']?></div><?php endif ?>
		
		<?php if ($templates): ?>
		<ul class="templates">
			<?php foreach ($templates as $template): ?>
			<li class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
				<a data-app="<?=$app->get_key()?>" data-template="<?=$template?>">
					<span class="cover">
						<span class="title"><?=$template?></span>
					</span>
				</a>
			</li>
			<?php endforeach ?>
		</ul>	
		<?php endif ?>
	
		<?=$doc?>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		
	<?php foreach ($ini as $h2 => $h3) : ?>

						
		<?php
			$content = null;
			foreach ($h3 as $h3 => $line)
			{
			//	Skip
				if (!in_array($h3, $skipAbout))
				{

					$td = null;
					if (is_array($line))
					{
						foreach ($line as $li) $td .= '<li>'.$li.'</li>';
						$td = '<ul>'.$td.'</ul>';
					}
					else $td = '<p>'.$line.'</p>';

					if ($td)
					{
						$content .= '
							<tr>
								<th>'.$h3.'</th>
								<td>'.Michelf\Markdown::defaultTransform($td).'</td>
							</tr>';
					}
				}
			}
		?>
						
	
		<?php if ($content): ?>
			<table><?=$content?></table>
		<?php endif ?>	

		<?php endforeach ?>
	</div>
</article>