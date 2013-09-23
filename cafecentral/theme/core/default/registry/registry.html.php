<div>Vue registre</div>
<div id="registry">
	<ul class="category">
		<?= '<li><a href="#">admin</a></li>'; ?>
		<?= '<li><a href="#">user</a></li>'; ?>
		<?= '<li><a href="#">site</a></li>'; ?>
		<?= '<li><a href="#">page</a></li>'; ?>
		<?= '<li><a href="#">version</a></li>'; ?>
		<? foreach($data as $key => $value): ?>
		<?= '<li><a href="#">'.$key.'</a></li>'; ?>
		<? endforeach; ?>
	</ul>
	<div id="ajax_registry_data"> 
		
	</div>
	<!--ul class="data">
		<?= '<li id="admin">'.new html(registry::$admin).'</li>'; ?>
		<?= '<li id="user">'.print_r($_SESSION['user'], true).'</li>'; ?>
		<?= '<li id="site">'.new html(registry::$site).'</li>'; ?>
		<?//= '<li id="page">'.new html(registry::$page).'</li>'; ?>
		<?= '<li id="version">'.new html(registry::$version).'</li>'; ?>
		<? foreach($data as $key => $value): ?>
		<?= '<li id="'.$key.'"><pre>'.print_r($value, true).'</pre></li>'; ?>
		<? endforeach; ?>
	</ul-->
</div>

<?php
	$obj = item::create('page', 'user');
	print '<pre>';print_r($obj->link());print'</pre>';
?>

<script charset="utf-8">
$(document).ready(function()
{
	$('#registry .category a').click(function()
	{
		var href = '<?= urlr::link('page', 'ajax'); ?>';
		$('#ajax_registry_data').load(href,function()
		{
			
				// var id = $(this).html();
				// 
				// $('#registry .category a').css('background-color', 'transparent');
				// $(this).css('background-color', '#FFF');
				// 
				// $('#registry .data>li').hide();
				// $('#' + id).toggle();
				// 
				// return false;
		});
	});
});

</script>