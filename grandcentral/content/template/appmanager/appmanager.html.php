<div class="apps">
	<ul>
		<?php foreach ($apps as $app): ?>
			<li class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
				<a href="<?=$appEdit['url'].'?app='.$app['key']?>">
					<span class="cover" <?php if (isset($app['about']['cover'])): ?>style="background-image:url('<?=$app['about']['cover']?>')"<?php endif ?>>
						<span class="title"><?=$app['about']['title']?></span>
					</span>
					<?php if (isset($app['about']['descr'])): ?><span class="descr"><?=$app['about']['descr']?></span><?php endif ?>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</div>