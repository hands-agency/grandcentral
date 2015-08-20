<div class="item col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<ul class="inhive">
	<?php foreach ($items as $item): ?>
		<?php
			$class = ($item['hasurl']->get() === true) ? null : 'class="minor"';
		?>
		<li <?=$class?>>
			<a href="<?=$listPage['url']->args(array('item' => $item['key']->get()))?>">
				<span class="icon"></span>
				<span class="title"><?=$item['title']?></span>
			</a>
		</li>
	<?php endforeach ?>
		<li class="add">
			<a href="<?=$editPage['url']->args(array('item' => 'item'))?>">
				<span class="icon"></span>
				<span class="title">+</span>
			</a>
		</li>
	</ul>
</div>

<div class="general col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<h1>
		<a href="<?=ADMIN_URL?>" class="site"><?=$siteTitle?></a>
	</h1>
	
	<ul class="big">
		<li>
			<a href="<?=$listPage['url']->args(array('item' => 'page'))?>">
				<span class="title">Organise the Site Tree</span>
			</a>
		</li>
		<li>
			<a href="<?=$listPage['url']->args(array('item' => 'item'))?>">
				<span class="title">Manage Items</span>
			</a>
		</li>
		<li>
			<a href="<?=$listPage['url']->args(array('item' => 'version'))?>">
				<span class="title">Deploy Versions</span>
			</a>
		</li>
		<li>
			<a href="<?=$appsPage['url']?>">
				<span class="title">Browse your Apps</span>
			</a>
		</li>
	</ul>
	
	<ul class="medium">
		<li>
		<?php foreach ($socials as $social): ?>
			<a href="<?=$listPage['url']->args(array('item' => $social['key']->get()))?>">
				<span class="title"><?=$social['title']?></span>
			</a>
		<?php endforeach ?>
		</li>
	</ul>
	
	<ul class="medium">
		<li>
			<a class="media" href="javascript://">
				<span class="title">Medias</span>
			</a>
		<?php foreach ($helps as $help): ?>
			<a href="<?=$help['url']?>">
				<span class="title"><?=$help['title']?></span>
			</a>
		<?php endforeach ?>
		</li>
	</ul>
	
	<ul class="small">
	<?php foreach ($logs as $log): ?>
		<li>
			<a href="<?=$log['url']?>">
				<span class="title"><?=$log['title']?></span>
			</a>
		</li>
	<?php endforeach ?>
	</ul>

</div>