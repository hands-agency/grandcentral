<? if ($count == 0) : ?>
<div class="nodata">Nope, sorry, nothing. Zero. Zilch.</div>
<? else : ?>
<h1><?=$_GET['item']?></h1>
<div class="infiniteScrollContainer"></div>
<div class="infiniteScrollWantsMore">More <?=$_GET['item']?>! Miam miam miam...</div>
<div class="infiniteScrollStopper">It's all I have.</div>

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
			template:'list/list',
			param:'<?=addslashes(json_encode($_PARAM))?>',
			target:'#adminContent section.active',
		});
	}
	
//	Launch infinitescroll each time
	container.removeData('infinitescroll');
	container.infinitescroll(
	{
		app:'content',
		template:'list/list.lines',
		param:'<?=addslashes(json_encode($_PARAM))?>',
		limit:<?=$limit?>,
		autoscroll:true,
	},
	function()
	{
		var $container = $('.inmasonry section[data-template="/list/list"]>.infiniteScrollContainer>ol');
		console.log($container);
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
<? endif ?>