<div id="general">
	<div class="site">
		<div class="title">Digest</div>
		<div class="icon"><?=$sitePic?></div>
	</div>
	<div class="profile">
		<div class="icon"><?=$profilePic?></div>
		<div class="title">Profile</div>
	</div>
</div>
<ul>
	<li class="structure">
		<h2><span>Stucture</span></h2>
		<ul class="inlist">
		<?php foreach ($socials as $social): ?>
			<li>
			<a href="<?=$listPage['url']->args(array('item' => $social['key']->get()))?>">
				<span class="icon"></span>
				<span class="title"><?=$social['title']?></span>
			</a>
			</li>
		<?php endforeach ?>
		</ul>
		<ul class="inlist">
		<?php foreach ($helps as $help): ?>
			<li>
			<a href="<?=$listPage['url']->args(array('item' => $help['key']->get()))?>">
				<span class="icon"></span>
				<span class="title"><?=$help['title']?></span>
			</a>
			</li>
		<?php endforeach ?>
		</ul>
		<ul class="inlist">
		<?php foreach ($logs as $log): ?>
			<li>
			<a href="<?=$listPage['url']->args(array('item' => $log['key']->get()))?>">
				<span class="icon"></span>
				<span class="title"><?=$log['title']?></span>
			</a>
			</li>
		<?php endforeach ?>
		</ul>
	</li>
	<li class="content">
		<ul class="inhive outline">
			<li>
				<a href="<?=$listPage['url']->args(array('item' => 'page'))?>">
					<span class="icon"></span>
					<span class="title">Site Tree</span>
				</a>
			</li>
			<li>
				<a href="<?=$listPage['url']->args(array('item' => 'item'))?>">
					<span class="icon"></span>
					<span class="title">Items</span>
				</a>
			</li>
			<li>
				<a href="<?=$listPage['url']->args(array('item' => 'version'))?>">
					<span class="icon"></span>
					<span class="title">Versions</span>
				</a>
			</li>
		</ul>
		<ul class="inhive">
		<?php foreach ($items as $item): ?>
			<?
				$class = ($item['hasurl']->get() === true) ? null : 'class="minor"';
			?>
			<li <?=$class?>>
				<a href="<?=$listPage['url']->args(array('item' => $item['key']->get()))?>">
					<span class="icon"></span>
					<span class="title"><?=$item['title']?></span>
				</a>
			</li>
		<?php endforeach ?>
		</ul>
	</li>
	<li class="app">
		<h2><span>Apps</span></h2>
		<ul class="inmasonry">
		<?php foreach ($apps as $app): ?>
			<li>
				<a href="<?=$appPage['url'].'?app='.$app['key']?>">
					<span class="icon"></span>
					<span class="title"><?=$app['title']?></span>
				</a>
			</li>
		<?php endforeach ?>
		</ul>
	</li>
</ul>