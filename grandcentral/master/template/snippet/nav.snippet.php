<button type="button" class="close"></button>
<ul>
	<li class="me">
		<div class="title"><?=media($_SESSION['user']['profilepic'][0]['url'])?><span>Prénom</span></div>
		<div class="sub"></div>
	</li>
	
	<? if (cc('page', current)['key'] == 'edit') : ?>
	<li class="editing" data-item="page_1"><a>editing</a></li>
	<? else :?>
	<li class="edit"><a>edit</a></li>
	<? endif ?>
	
	<? foreach ($level1 as $page): ?>
	<? $truc = $page['key']->get();?>
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
			<? $link = $level2['link'] ?>
			<? $display = $level2['display'] ?>
			
			<? if ($count > 0): ?>

			<? if (count($level2Bunch) > 1) : ?><h1><?=cst('NAV_SUB_H1_'.$key, $key)?></h1><? endif ?>
			
			<ul class="<?=$key?> <?=$display?>">
				<? foreach ($bunch as $subpage): ?>
				<?
				//	Title & descr
					$title = cst('ITEM_'.$subpage['key'].'_TITLE', $subpage['title']);
					$descr = cst('ITEM_'.$subpage['key'].'_DESCR', $subpage['descr']);
					
				//	Find the link
					switch ($link)
					{
						case 'edit':
							$url = $editPage['url']->args(array('item' => $subpage->get_table(), 'id' => $subpage['id']->get()));
							break;
						case 'list':
							// print'<pre>';print_r($listPage['url']->get());print'</pre>';
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
						<span class="icon" <? if (isset($subpage['icon'])): ?>data-icon="<?=$subpage['icon']?>"<? endif ?>></span>
						<span class="title"><?=$title?></span>
						<span class="descr"><?=$descr?></span>
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
