<button type="button" class="close"></button>
<ul>	
	<? foreach ($level1 as $page): ?>
	<? $truc = $page['key']->get();?>
	<? $config = $nav[$truc] ?>
	<? $title = (isset($config['title'])) ? $config['title'] : $page['title'] ?>
	<? $content = (isset($config['content'])) ? $config['content'] : null ?>
	<? $level2Bunch = (isset($config['subnav']) && is_array($config['subnav'])) ? $config['subnav'] : null ?>
	<? $level2Content = (isset($config['subnav']) && is_string($config['subnav'])) ? $config['subnav'] : null ?>
	<?
		$icon = (isset($config['icon'])) ?  'data-feathericon="&#xe'.$config['icon'].'"' : null;
		$image = (isset($config['image'])) ? media($config['image']) : null;
	//	On / off ?
		$on = null;
	?>
	<li class="<?=$page['key']?> <?=$on?>">
		<? if ($title): ?><div class="title" <?=$icon?>><?=$image?><span><?=$title?></span></div><? endif ?>
		
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
			<? $link = $level2['link'] ?>
			<? $display = $level2['display'] ?>
			
			<? if ($count > 0): ?>

			<? if (count($level2Bunch) > 1) : ?><h1><span class="centered"><?=cst('NAV_SUB_H1_'.$key)?></span></h1><? endif ?>
			
			<ul class="<?=$key?> <?=$display?>">
				<? foreach ($bunch as $subpage): ?>
				<?
				//	Title & descr
					
					$title = cst('ITEM_'.$subpage['key'].'_TITLE');
					if ($title == 'ITEM_'.strtoupper($subpage['key']).'_TITLE')
					{
						$title = $subpage['title'];
					}
					
				//	Find the link
					switch ($link)
					{
						case 'edit':
							$url = $editPage['url']->args(array('item' => $subpage->get_table(), 'id' => $subpage['id']->get()));
							break;
						case 'list':
							$url = $listPage['url']->args(array('item' => $subpage['key']->get()));
							break;
						case 'page':
							$url = $subpage['url'];
							break;
						
						default:
							$url = $link.'?app='.$subpage['key'];
							break;
					}
					?>					
				<li>
					<a href="<?=$url ?>">
						<span class="icon" <? if (isset($subpage['icon']) && !$subpage['icon']->is_empty()): ?>data-feathericon="&#xe<?=$subpage['icon']?>"<? endif ?>></span>
						<span class="title"><?=$title?></span>
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
