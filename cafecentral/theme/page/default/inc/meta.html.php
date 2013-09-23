<?php
	$tag = array(
		array('tag' => 'meta', 'charset' => 'utf-8'),
		array('tag' => 'title', 'html' => cc(env, current)->get_attr('title').' — '.cc('page', current)->get_attr('title')),
	//	meta
		array('tag' => 'meta', 'http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'),
		array('tag' => 'meta', 'name' => 'description', 'content' => cc('page', current)->get_attr('descr')),
		array('tag' => 'meta', 'name' => 'author', 'content' => ''),
		array('tag' => 'meta', 'name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'),
		array('tag' => 'meta', 'property' => 'cc:item', 'content' => 'page'),
		array('tag' => 'meta', 'property' => 'cc:id', 'content' => cc('page', current)->get_attr('id')),
	//	link
		array('tag' => 'link', 'rel' => 'canonical', 'content' => URL),
		array('tag' => 'link', 'rel' => 'shortcut icon', 'href' => '/favicon/favicon.ico'),
		array('tag' => 'link', 'rel' => 'apple-touch-icon', 'href' => '/favicon/apple-touch-icon.png'),
	);
//	Possibly command base target via _GET (nice to get out of an full page iframe)
	if (isset($_GET['target'])) $tag[] = array('tag' => 'base', 'target' => $_GET['target']);
	
//	Print
	echo markup::tag($tag);
?>