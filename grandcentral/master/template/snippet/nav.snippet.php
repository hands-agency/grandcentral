<button type="button" class="close"></button>
<ul>
	<? foreach ($level1 as $page): ?>
	<? $truc = (string)$page['key'];?>
	<? $config = $nav[$truc] ?>
	<? $level2 = $config['subnav'] ?>
	<? $title = (is_string($config['title'])) ? $config['title'] : $page['title'] ?>
	<? $descr = (is_string($config['descr'])) ? $config['descr'] : $page['descr'] ?>
	
	<li class="<?=$page['key']?>" title="<?=$page['title']?>">
		<? if ($config['icon'] != false) : ?><div class="icon" data-icon="<?=$config['icon']?>"></div><? endif ?>
		<? if ($config['title'] != false) : ?><div class="title"><a href="/admin<?=$page['url']?>"><?=$title?></a><? if ($config['flag'] === true) : ?> <a href="/admin/en" class="flag">fr</a><? endif ?></div><? endif ?>
		<? if ($config['descr'] != false) : ?><div class="descr"><?=$page['descr']?></div><? endif ?>
		<div class="sub">

			<? foreach ($level2 as $key => $level2): ?>
			<? $bunch = $level2['bunch'] ?>

			<? $link = $level2['link'] ?>
			<? $display = $level2['display'] ?>
			<? if ($bunch->count()): ?>

			<h1><?=$key;?></h1>
			<ul class="<?=$key?> <?=$display?>">
				<? foreach ($bunch as $subpage): ?>
				<? if ($link == 'edit') $url = '/admin/edit?item='.$subpage->get_table().'&id='.$subpage['id'] ?>
				<? if ($link == 'list') $url = '/admin/list?item='.$subpage['key'] ?>
				<li>
					<a href="<?=$url ?>">
						<span class="icon"><? if (isset($subpage['icon'])): ?><i class="icon-<?=$subpage['icon']?>"></i><? endif ?></span>
						<span class="title"><?=$subpage['title']?></span>
						<span class="descr"><?=$subpage['descr']->cut(200)?></span>
					</a>
				</li>
				<? endforeach ?>
			</ul>	
			<? endif ; endforeach ?>
		
		</div>
	</li>
	<? endforeach ?>
</ul>
<div class="clear"><!-- Clearing floats --></div>
