<button type="button" class="close"></button>
<ul>
	<li class="me">
		<div class="title"><?=media($_SESSION['user']['profilepic'][0])?><span>Prénom</span></div>
		<div class="sub"></div>
	</li>
	<? foreach ($level1 as $page): ?>
	
	<? $truc = (string)$page['key'];?>
	<? $config = $nav[$truc] ?>
	<? $title = (isset($config['title'])) ? $config['title'] : $page['title'] ?>
	<? $content = (isset($config['content'])) ? $config['content'] : null ?>
	<? $level2Bunch = (isset($config['subnav']) && is_array($config['subnav'])) ? $config['subnav'] : null ?>
	<? $level2Content = (isset($config['subnav']) && is_string($config['subnav'])) ? $config['subnav'] : null ?>
	<?
		$icon = (isset($config['icon'])) ? $config['icon'] : null;
	//	On / off ?
		$on = null;
	?>
	<li class="<?=$page['key']?> <?=$on?>">
		<? if ($title): ?><div class="title" data-icon="<?=$icon?>"><span><?=$title?></span></div><? endif ?>
		
		<? if ($level2Bunch OR $level2Content): ?>
		<div class="sub">
			
			<? if ($level2Content) echo $level2Content; ?>

			<? if ($level2Bunch) : foreach ($level2Bunch as $key => $level2): ?>
			
			<?
				if (isset($level2['bunch']))
				{
					$bunch = $level2['bunch'];
					$count = $bunch->count();
				}
				if (isset($level2['array']))
				{
					$bunch = $level2['array'];
					$count = count($bunch);
				}
			?>
			<? $h1 = (isset($key)) ? $key : null ?>
			<? $link = $level2['link'] ?>
			<? $display = $level2['display'] ?>
			
			<? if ($count > 0): ?>

			<? if (isset($h1) && count($level2Bunch) > 1) : ?>			
			<h1><?= cst('NAV_SUB_H1_'.$h1, $h1) ?></h1>
			<? endif ?>
			<ul class="<?=$key?> <?=$display?>">
				<? foreach ($bunch as $subpage): ?>
				<?
				//	Title & descr
					$title = cst('ITEM_'.$subpage['key'].'_TITLE', $subpage['title']);
					$descr = cst('ITEM_'.$subpage['key'].'_DESCR', $subpage['descr']);
				?>
				<? if ($link == 'edit') $url = '/admin/edit?item='.$subpage->get_table().'&id='.$subpage['id'] ?>
				<? if ($link == 'list') $url = '/admin/list?item='.$subpage['key'] ?>
				<? if ($link == 'page') $url = $subpage['url'] ?>
				<li>
					<a href="<?=$url ?>">
						<span class="icon" <? if (isset($subpage['icon'])): ?>data-icon="<?=$subpage['icon']?>"<? endif ?>></span>
						<span class="title"><?=$title?></span>
						<span class="descr"><?=$descr->cut(200)?></span>
					</a>
				</li>
				<? endforeach ?>
			</ul>	
			<? endif ; endforeach ; endif; ?>
		
		</div>
		<? endif ?>
	</li>
	<? endforeach ?>
</ul>
<div class="clear"><!-- Clearing floats --></div>
