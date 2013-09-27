<meta charset="utf-8" />
<title><?=cc(env, current)['title']?> — <?=cc('page', current)['title']?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="<?=cc('page', current)['descr']?>" />
<meta name="author" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta property="cc:item" content="page" />
<meta property="cc:id" content="<?=cc('page', current)['id']?>" />
<link rel="canonical" content="<?=URL?>" />
<link rel="shortcut icon" href="/favicon/favicon.ico" />
<link rel="apple-touch-icon" href="/favicon/apple-touch-icon.png" />
<?
//	Possibly command base target via _GET (nice to get out of an full page iframe)
	if (isset($_GET['target'])) echo '<base target="'.$_GET['target'].'" />';
?>