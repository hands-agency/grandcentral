<?php if ($count != 0) : ?>
<div class="infiniteScrollContainer"></div>
<div class="infiniteScrollWantsMore" data-feathericon="&#xe129"></div>
<div class="infiniteScrollStopper"><?=cst('stopper')?></div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function()
{
//	Some vars
	container = $('#adminContent section.active');

//	The first time only...
	if (container.data('infinitescroll') == undefined)
	{
	//	... Search as you type for the list
		$('#refine').show();
		$('#refine input').searchasyoutype(
		{
			app:'content',
			template:'/list/list',
			param:'<?=addslashes(json_encode($_PARAM["param"]))?>',
			target:'#adminContent section.active',
		});
	}
	
//	Launch infinitescroll each time
	container.removeData('infinitescroll');
	container.infinitescroll(
	{
		app:'content',
		template:'/list/list.lines',
		param:'<?=addslashes(json_encode($_PARAM["param"]))?>',
		limit:<?=$limit?>,
		autoscroll:true
	},
	function()
	{
		var $container = $('section[data-template="/list/list"][data-pref-display="inmasonry"]>.infiniteScrollContainer>ol');
	//	initialize Masonry after all images have loaded  
		$container.imagesLoaded( function()
		{
			$container.masonry(
			{
				itemSelector: 'li[data-item]',
				gutter: 15,
				isAnimated: true
			});
		});
	});
});
</script>
<?php endif ?>