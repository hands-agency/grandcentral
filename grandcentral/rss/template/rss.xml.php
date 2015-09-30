<?php 	
	$items = i($_PARAM['item'],array(
		'order()' => 'created desc'
	));

	$object = i('item',$_PARAM['item']);

	$attributes = array();
	if(isset($object['attr']['title']))
		$attributes[] = array('title', 'title');

	if(isset($object['attr']['descr']))
		$attributes[] = array('descr', 'description');

	if(isset($object['attr']['description']))
		$attributes[] = array('description', 'description');

	if(isset($object['attr']['url']))
		$attributes[] = array('url', 'link');

	if(isset($object['attr']['created']))
		$attributes[] = array('created', 'pubDate');

	if(isset($object['attr']['updated']))
		$attributes[] = array('updated', 'lastBuildDate');



	$page = i('page',current)['url'];
?>

<rss version="2.0">
    <channel>
    	<title> <?= $_PARAM['title'] ?> </title>
    	<description> <?= $_PARAM['descr'] ?> </description>
    	<link> <?= $page ?> </link>
    	<category> <?= $object['title'] ?> </category>
    	<language> <?= i('version', current)['key']; ?> </language>
    	<pubDate> <?= date('Y-m-d G-i-s') ?> </pubDate>
    	<?php foreach($items as $item) : ?>
    	<item>
    		<?php foreach($attributes as $attribute) : ?>
    			<<?= $attribute[1] ?>><?= $item[$attribute[0]] ?></<?= $attribute[1] ?>>
	    	<?php endforeach; ?>
    	</item>
	    <?php endforeach ?>
    </channel>
</rss>